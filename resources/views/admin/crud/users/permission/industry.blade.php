<div class="accordion-item">
    <h2 class="accordion-header">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#industries" aria-expanded="true" aria-controls="industries">
            <label class="form-check-label" for="industries">Industries</label>
        </button>
    </h2>
    <div id="industries" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
        <div class="accordion-body">

            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="industry" value="industry" name="permission[industry]"
                    {{--                                                            {{ (json_decode($user->permission) && in_array('user_profile', json_decode($user->permission, true) ?? [])) ? 'checked' : '' }} --}}
                />
                <label class="form-check-label" for="industry">Industries</label>
            </div>

            <ul class="row d-flex col-12">
                <li class="col-4">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="industry_manage" id="industry_manage" name="permission[industry][industry_manage]" data-checkem-parent="permission[industry]"
                            {{ (json_decode($user->permission) && in_array('industry_manage', json_decode($user->permission, true)['industry'] ?? [])) ? 'checked' : '' }} />
                        <label class="form-check-label" for="industry_manage">Industry Manage</label>
                    </div>
                </li>
                <li class="col-4">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="industry_detail" id="industry_detail" name="permission[industry][industry_detail]" data-checkem-parent="permission[industry]"
                            {{ (json_decode($user->permission) && in_array('industry_detail', json_decode($user->permission, true)['industry'] ?? [])) ? 'checked' : '' }} />
                        <label class="form-check-label" for="industry_detail">Industry Detail</label>
                    </div>
                </li>
                <li class="col-4">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="industry_create" id="industry_create" name="permission[industry][industry_create]" data-checkem-parent="permission[industry]"
                            {{ (json_decode($user->permission) && in_array('industry_create', json_decode($user->permission, true)['industry'] ?? [])) ? 'checked' : '' }} />
                        <label class="form-check-label" for="industry_create">Industry Create</label>
                    </div>
                </li>
                <li class="col-4">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="industry_edit" id="industry_edit" name="permission[industry][industry_edit]" data-checkem-parent="permission[industry]"
                            {{ (json_decode($user->permission) && in_array('industry_edit', json_decode($user->permission, true)['industry'] ?? [])) ? 'checked' : '' }} />
                        <label class="form-check-label" for="industry_edit">Industry Edit</label>
                    </div>
                </li>
                <li class="col-4">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="industry_status" id="industry_status" name="permission[industry][industry_status]" data-checkem-parent="permission[industry]"
                            {{ (json_decode($user->permission) && in_array('industry_status', json_decode($user->permission, true)['industry'] ?? [])) ? 'checked' : '' }} />
                        <label class="form-check-label" for="industry_status">Industry Status</label>
                    </div>
                </li>
                <li class="col-4">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="industry_delete" id="industry_delete" name="permission[industry][industry_delete]" data-checkem-parent="permission[industry]"
                            {{ (json_decode($user->permission) && in_array('industry_delete', json_decode($user->permission, true)['industry'] ?? [])) ? 'checked' : '' }} />
                        <label class="form-check-label" for="industry_delete">Industry Delete</label>
                    </div>
                </li>
            </ul>

        </div>
    </div>
</div>
