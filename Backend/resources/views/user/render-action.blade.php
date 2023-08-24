<td scope="row" class="text-center">
    <a href="{{route('user.show',$user->id)}}" data-toggle="tooltip"
       data-coreui-placement="top" data-coreui-title="Chi tiết">{!!$user->id!!}</a>
</td>
<td class="text-center text-break"><a href="{{route('user.show',$user->id)}}"
                                      data-toggle="tooltip" data-coreui-placement="top"
                                      data-coreui-title="Chi tiết">{!!$user->fullname!!}</a>
</td>
<td class="text-center text-break">{!!$user->username!!}</td>
<td class="text-center text-break">{!!$user->email!!}</td>
<td class="text-center text-break">{!!$user->phone_number!!}</td>
<td class="text-center text-break">{!!$user->convertRole($user->role)!!}</td>
<td class="text-center text-break">{!!$user->convertStatus($user->active)!!}</td>
<td class="text-center text-break">{!!$user->formatDate($user->updated_at)!!}</td>
<td class="">
    @if(Auth::user()->role == \App\Models\User::ROLE_ADMIN)
        <div class="d-flex jt-cont-sp-bw">
            <a data-toggle="tooltip" data-coreui-placement="top"
               data-coreui-title="Cập nhật" href="{{route('user.edit',$user->id)}}">
                <i class="p-r fas fa-edit fa-lg"></i>
            </a>
            @if($user->active == 1)
                <a data-toggle="tooltip" data-id="{{$user->id}}" data-coreui-placement="top"
                   data-coreui-title="Đã kích hoạt" class="user-unlock">
                    <i class="icon-lock fas fa-user-unlock fa-lg mr-3 cl-green"></i>
                </a>
            @elseif($user->active == 0)
                <a data-toggle="tooltip" data-id="{{$user->id}}" data-coreui-placement="top"
                   data-coreui-title="Vô hiệu hóa" class="user-lock">
                    <i class="icon-user-lock fas fa-user-lock fa-lg mr-3 cl-red"></i>
                </a>
            @endif
            @if(\App\Models\User::ROLE_ADMIN != $user->role)
                <a data-toggle="tooltip" data-id="{{$user->id}}" data-coreui-placement="top"
                   data-coreui-title="Xóa" class="user-delete">
                    <i class="fas fa-trash fa-lg cl-red"></i>
                </a>
            @endif
        </div>
    @endif
</td>