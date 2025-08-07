<div class="accordion-item">
    <h2 class="accordion-header">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#apps" aria-expanded="true" aria-controls="apps">
            <label class="form-check-label" for="apps">Apps</label>
        </button>
    </h2>
    <div id="apps" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
        <div class="accordion-body">

            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="app" value="app" name="permission[app]"
                    {{--                                                            {{ (json_decode($user->permission) && in_array('user_profile', json_decode($user->permission, true) ?? [])) ? 'checked' : '' }} --}}
                />
                <label class="form-check-label" for="app">Apps</label>
            </div>

            <ul class="row d-flex col-12">
                <li class="col-4">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="app_manage" id="app_manage" name="permission[app][app_manage]" data-checkem-parent="permission[app]"
                            {{ (json_decode($user->permission) && in_array('app_manage', json_decode($user->permission, true)['app'] ?? [])) ? 'checked' : '' }} />
                        <label class="form-check-label" for="app_manage">App Manage</label>
                    </div>
                </li>
                <li class="col-4">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="app_detail" id="app_detail" name="permission[app][app_detail]" data-checkem-parent="permission[app]"
                            {{ (json_decode($user->permission) && in_array('app_detail', json_decode($user->permission, true)['app'] ?? [])) ? 'checked' : '' }} />
                        <label class="form-check-label" for="app_detail">App Detail</label>
                    </div>
                </li>
                <li class="col-4">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="app_create" id="app_create" name="permission[app][app_create]" data-checkem-parent="permission[app]"
                            {{ (json_decode($user->permission) && in_array('app_create', json_decode($user->permission, true)['app'] ?? [])) ? 'checked' : '' }} />
                        <label class="form-check-label" for="app_create">App Create</label>
                    </div>
                </li>
                <li class="col-4">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="app_edit" id="app_edit" name="permission[app][app_edit]" data-checkem-parent="permission[app]"
                            {{ (json_decode($user->permission) && in_array('app_edit', json_decode($user->permission, true)['app'] ?? [])) ? 'checked' : '' }} />
                        <label class="form-check-label" for="app_edit">App Edit</label>
                    </div>
                </li>
                <li class="col-4">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="app_status" id="app_status" name="permission[app][app_status]" data-checkem-parent="permission[app]"
                            {{ (json_decode($user->permission) && in_array('app_status', json_decode($user->permission, true)['app'] ?? [])) ? 'checked' : '' }} />
                        <label class="form-check-label" for="app_status">App Status</label>
                    </div>
                </li>
                <li class="col-4">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="app_delete" id="app_delete" name="permission[app][app_delete]" data-checkem-parent="permission[app]"
                            {{ (json_decode($user->permission) && in_array('app_delete', json_decode($user->permission, true)['app'] ?? [])) ? 'checked' : '' }} />
                        <label class="form-check-label" for="app_delete">App Delete</label>
                    </div>
                </li>
            </ul>

        </div>
    </div>
</div>
