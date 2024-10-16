@extends('layouts.admin')
@section('dashboard_bar')
User Role
@endsection


@section('content')
<div class="row">
    <div class="col-12">
        <form action="{{url('/usersetup/SaveUserRole')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="user_role_id" value="@if(isset($UserRole)){{ $UserRole->id }}@endif">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Role Name <span style="color:red;">*</span></label>
                                <input type="text" name="role_name" class="form-control" placeholder="Role Name" value="@if(isset($UserRole)){{ $UserRole->role_name }}@endif" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered table-responsive-sm">
                        <thead>
                            <tr>
                                <th>Menu</th>
                                <th>Child Menu</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($MenuList as $MItems)
                            <?php
                            $SubMenusItems = array_filter($SubMenuList, function ($sitems) use ($MItems) {
                                return $sitems->menu_id == $MItems->id;
                            });
                            ?>
                            @if(count($SubMenusItems) > 0)
                            @foreach ($SubMenusItems as $item)
                            <tr>
                                <td>{{ $MItems->menu_name }}</td>
                                <td>{{ $item->menu_name }}</td>
                                <td>
                                    <label>
                                        <div class="custom-control custom-checkbox mb-3 checkbox-success">
                                            @if(in_array($item->id, $RoleSubMenuList))
                                            <input type="checkbox" class="custom-control-input" id="chkMenuId_{{ $MItems->id_name }}_{{ $item->id }}" name="chkMenus[]" value="{{ $MItems->id }}_{{ $item->id }}" checked>
                                            @else
                                            <input type="checkbox" class="custom-control-input" id="chkMenuId_{{ $MItems->id_name }}_{{ $item->id }}" name="chkMenus[]" value="{{ $MItems->id }}_{{ $item->id }}">
                                            @endif

                                            <label class="custom-control-label" for="chkMenuId_{{ $MItems->id_name }}_{{ $item->id }}">&nbsp;</label>
                                        </div>
                                    </label>
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td>{{ $MItems->menu_name }}</td>
                                <td></td>
                                <td>
                                    <label>
                                        <div class="custom-control custom-checkbox mb-3 checkbox-success">
                                            @if(in_array($MItems->id, $RoleMenuList))
                                            <input type="checkbox" class="custom-control-input" id="chkMenuId_{{ $MItems->id_name }}" name="chkMenus[]" value="{{ $MItems->id }}_0" checked>
                                            @else
                                            <input type="checkbox" class="custom-control-input" id="chkMenuId_{{ $MItems->id_name }}" name="chkMenus[]" value="{{ $MItems->id }}_0">
                                            @endif

                                            <label class="custom-control-label" for="chkMenuId_{{ $MItems->id_name }}">&nbsp;</label>
                                        </div>
                                    </label>
                                </td>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <button type="submit" class="btn btn-sm btn-success">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection