<div class="accordion-item">
    <h2 class="accordion-header">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#users" aria-expanded="true" aria-controls="users">
            <label class="form-check-label" for="users">
                Users
            </label>
        </button>
    </h2>
    <div id="users" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
        <div class="accordion-body">

            <div class="row ms-1">
                <div class="form-check col-md-12">
                    <input class="form-check-input" type="checkbox" id="users_all" value="users_all" name="permission[users_all]"
{{--                                                                                        {{ (json_decode($user->permission) && in_array('users_all', json_decode($user->permission, true) ?? [])) ? 'checked' : '' }} --}}
                    />
                    <label class="form-check-label" for="users_all">Users All</label>
                </div>
            </div>

            <div class="row mx-1">
                <ul>
                    <li>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="employ_all" value="employ_all" name="permission[users_all][employ_all]" data-checkem-parent="permission[users_all]"
                                {{ (json_decode($user->permission, true) && is_array(json_decode($user->permission, true)['users_all'] ?? [] ? 'checked' : '') && in_array('employ_all', json_decode($user->permission, true)['users_all'])) ? 'checked' : '' }} />
                            <label class="form-check-label" for="employ_all">Users All</label>
                        </div>
                        <ul class="row d-flex col-12">
                            <li class="col-4">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="employ_manage" value="employ_manage" name="permission[users_all][employ_all][employ_manage]" data-checkem-parent="permission[users_all][employ_all]"
                                        {{ (json_decode($user->permission) && in_array('employ_manage', json_decode($user->permission, true)['users_all']['employ_all'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="employ_manage">Manage User</label>
                                </div>
                            </li>
                            <li class="col-4">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="employ_detail" value="employ_detail" name="permission[users_all][employ_all][employ_detail]" data-checkem-parent="permission[users_all][employ_all]"
                                        {{ (json_decode($user->permission) && in_array('employ_detail', json_decode($user->permission, true)['users_all']['employ_all'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="employ_detail">User Detail</label>
                                </div>
                            </li>
                            <li class="col-4">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="employ_create" value="employ_create" name="permission[users_all][employ_all][employ_create]" data-checkem-parent="permission[users_all][employ_all]"
                                        {{ (json_decode($user->permission) && in_array('employ_create', json_decode($user->permission, true)['users_all']['employ_all'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="employ_create">User Create</label>
                                </div>
                            </li>
                            <li class="col-4">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="employ_edit" value="employ_edit" name="permission[users_all][employ_all][employ_edit]" data-checkem-parent="permission[users_all][employ_all]"
                                        {{ (json_decode($user->permission) && in_array('employ_edit', json_decode($user->permission, true)['users_all']['employ_all'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="employ_edit">User edit</label>
                                </div>
                            </li>
                            <li class="col-4">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="employ_permission" value="employ_permission" name="permission[users_all][employ_all][employ_permission]" data-checkem-parent="permission[users_all][employ_all]"
                                        {{ (json_decode($user->permission) && in_array('employ_permission', json_decode($user->permission, true)['users_all']['employ_all'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="employ_permission">User Permission</label>
                                </div>
                            </li>
                            <li class="col-4">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="employ_password" value="employ_password" name="permission[users_all][employ_all][employ_password]" data-checkem-parent="permission[users_all][employ_all]"
                                        {{ (json_decode($user->permission) && in_array('employ_password', json_decode($user->permission, true)['users_all']['employ_all'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="employ_password">User Change Password</label>
                                </div>
                            </li>
                            <li class="col-4">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="employ_delete" value="employ_delete" name="permission[users_all][employ_all][employ_delete]" data-checkem-parent="permission[users_all][employ_all]"
                                        {{ (json_decode($user->permission) && in_array('employ_delete', json_decode($user->permission, true)['users_all']['employ_all'] ?? [])) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="employ_delete">User Delete</label>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>

        </div>
    </div>
</div>
