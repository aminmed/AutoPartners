<div class="row">
    <div class="col-md-12">
        <div class="form-body">
        <div class="row">
                <div class="col-md-7">
                    <div class="form-group">
                        <label>chercher</label>
                        <div class="input-group">
                            <input type="text" class="form-control search" id="focus_field" value="{{ $data['search'] }}" placeholder="mots clefs" autofocus="" autocomplete="off">
                            <div class="input-group-append">
                                <button class="btn btn-primary" id="urlSearch" data-url="{{ $data['route'] }}?orderKey={{ $data['orderKey'] }}&orderBy={{ $data['orderBy'] }}&search=" type="button">
                                    <i class="ft-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                    <label><p></p></label>
                        <select class="form-control btn-primary" id="urlSelect">
                            @foreach ($data['orderKeyList'] as $key => $value)
                                <option data-url="{{ $data['route'] }}?orderKey={{ $key }}&orderBy={{ $data['orderBy'] }}&search={{ $data['search'] }}" {{ $data['orderKey'] == $key ? "selected" : "" }}>{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label><p></p></label>
                        <select class="form-control btn-primary" id="urlSelect">
                            <option data-url="{{ $data['route'] }}?orderKey={{ $data['orderKey'] }}&orderBy=asc&search={{ $data['search'] }}" {{ $data['orderBy'] == "asc" ? "selected" : "" }}>Ordre croissant</option>
                            <option data-url="{{ $data['route'] }}?orderKey={{ $data['orderKey'] }}&orderBy=desc&search={{ $data['search'] }}" {{ $data['orderBy'] == "desc" ? "selected" : "" }}>Ordre décroissant</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="table-responsive">
    <table class="table table-bordered">
        <thead class="bg-primary text-white">
            <tr>
                <th>lu</th>
                <th>expéditeur</th>
                <th>message</th>
                <th>date </th>
                <th>option</th>
            </tr>
        </thead>
        <tbody class="bg-white">
            @foreach ($lists as $list)
            <tr id="tr-{{ $list->id }}">
                <td>
                {{ $list->read }}
                </td>
                <td>
                    {{ $list->name }}
                    <br>
                    {{ $list->email }}
                </td>
                <td>
                    <b>{!! nl2br($list->subject) !!}</b> <br>
                    {!! nl2br($list->text_en) !!}
                </td>
                <td>
                   <span class="text-primary" data-toggle="tooltip" data-placement="top" data-original-title="{{ $list->created_at }}">
                        {{ $list->created_at->diffForHumans() }}
                    </span>
                    <br>
                    <span class="text-danger" data-toggle="tooltip" data-placement="top" data-original-title="{{ $list->updated_at }}">
                        {{ $list->updated_at->diffForHumans() }}
                    </span>
                </td>
                <td class="text-center">
                    <a href="{{ route($data['sub'].'.edit', $list->id) }}" data-toggle="tooltip" data-placement="top" data-original-title="{{ $data['buttom_edit'] }}" class="btn btn-sm btn-success white">
                        <i class="fa fa-pencil"></i>
                    </a>
                    <a id="option" data-url="{{ route($data['sub'].'.destroy', $list->id) }}" data-id="{{ $list->id }}" data-div="tr" data-page="list" data-message="{{ $data['message_destroy'] }}" data-toggle="tooltip" data-placement="top" data-original-title="{{ $data['buttom_destroy'] }}" class="btn btn-sm btn-danger white">
                        <i class="fa fa-trash"></i>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="float-right">
    {{ $lists->links() }}
</div>