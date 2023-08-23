<?php

namespace App\Models;

trait CustomInsertTrait
{
    /**
     * Return the next insert id.
     *
     * @return string
     * @throws \Exception
     */
    public function nextCustomizeValue($maxId)
    {
        $this->validateCustomInsert();

        $prefix = $this->customizePrefix();
        $prefix_len = $this->customizePrefixLenght();

        return $prefix . ($maxId >= (int)('1' . str_pad('', (int)$prefix_len, '0')) ? $maxId : str_pad($maxId, (int)$prefix_len, '0', STR_PAD_LEFT));
    }

    /**
     * Validate custom insert on model.
     *
     * @return void
     * @throws \Exception
     */
    public function validateCustomInsert()
    {
        $class = get_class($this);

        if (empty($this->customizeField())) {
            throw new \Exception("Custom-insert model {$class} must have a value for customizeField().");
        }

        if (empty($this->customizePrefix())) {
            throw new \Exception("Custom-insert model {$class} must have a value for customizePrefix().");
        }
    }

    /**
     * Return customize prefix field.
     *
     * @return mixed.
     */
    public function customizeField()
    {
        //return;
        return strtolower(basename(str_replace('\\', '/', get_class($this))) . '_id');
    }

    /**
     * Return customize prefix.
     *
     * @return mixed.
     */
    public function customizePrefix()
    {
        return;
    }

    /**
     * Return customize prefix lenght.
     *
     * @return mixed.
     */
    public function customizePrefixLenght()
    {
        return 4;
    }

    /**
     * Override. Save the model to the database. Use custom-insert for inserts.
     *
     * @param array $options
     * @return bool
     */
    public function save(array $options = array())
    {
        $customizeField = $this->customizeField();

        if (empty($this->$customizeField)) {
            $saved = parent::save($options);

            if(!empty($this->id)) {
                $this->$customizeField = $this->nextCustomizeValue($this->id);

                static::where('id', $this->id)->update([
                    $customizeField => $this->$customizeField
                ]);
            }

            return $saved;
        } else {
            return parent::save($options);
        }
    }

    /**
     * Override. Save the model to the database. Use custom-insert for inserts.
     *
     * @param array $options
     * @return bool
     */
    public function create(array $values)
    {
        foreach ($values as $key => $val) {
            $this->$key = $val;
        }

        $insert_id = parent::insertGetId($values);
        if ($insert_id) {
            $customizeField = $this->customizeField();

            if (empty($values[$customizeField])) {
                $this->$customizeField = $this->nextCustomizeValue($insert_id);
                static::where('id', $insert_id)->update([
                    $customizeField => $this->$customizeField
                ]);
            }
        } else {
            throw new \Exception("Create new item for " . get_class($this) . " failed.");
        }

        return $insert_id;
    }
}
