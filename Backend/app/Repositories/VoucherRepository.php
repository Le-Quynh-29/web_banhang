<?php
namespace App\Repositories;

use App\Repositories\Support\AbstractRepository;
use Illuminate\Container\Container as App;
use Illuminate\Http\Request;

class VoucherRepository extends AbstractRepository
{
    public function model()
    {
        return 'App\Models\DiscountVoucher';
    }

    public function __construct(App $app)
    {
        parent::__construct($app);
    }

    /**
     * Get list voucher
     * @param Request $request
     * @param bool $toArray
     * @param array $with
     * @return mixed
     */
    public function getListVoucher($request, $toArray = false, $with = [])
    {
        $status = $request->get('status');
        $type = $request->get('type');
        $startDiscount = $request->get('start_discount');
        $endDiscount = $request->get('end_discount');

        $data = parent::all($request, null);

        if (!is_null($status)) {
            $data = $data->where('status', $status);
        }

        if (!is_null($type)) {
            $data = $data->where('type', $type);
            if (!is_null($startDiscount) && !is_null($endDiscount)) {
                $data = $data->whereBetween('discount', [$startDiscount, $endDiscount]);
            } elseif (!is_null($startDiscount) && is_null($endDiscount)) {
                $data = $data->where('discount', '>=', $startDiscount);
            } elseif (is_null($startDiscount) && !is_null($endDiscount)) {
                $data = $data->where('discount', '<=', $startDiscount);
            }
        }

        return $data->paginate(self::PAGE_SIZE);
    }
}
