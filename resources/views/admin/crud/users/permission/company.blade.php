<div class="accordion-item">
    <h2 class="accordion-header">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#companies" aria-expanded="true" aria-controls="companies">
            <label class="form-check-label" for="companies">Companies</label>
        </button>
    </h2>
    <div id="companies" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
        <div class="accordion-body">

            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="company" value="company" name="permission[company]"
                    {{--                                                            {{ (json_decode($user->permission) && in_array('user_profile', json_decode($user->permission, true) ?? [])) ? 'checked' : '' }} --}}
                />
                <label class="form-check-label" for="company">Companies</label>
            </div>

            <ul class="row d-flex col-12">
                <li class="col-4">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="company_manage" id="company_manage" name="permission[company][company_manage]" data-checkem-parent="permission[company]"
                            {{ (json_decode($user->permission) && in_array('company_manage', json_decode($user->permission, true)['company'] ?? [])) ? 'checked' : '' }} />
                        <label class="form-check-label" for="company_manage">Company Manage</label>
                    </div>
                </li>
                <li class="col-4">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="company_detail" id="company_detail" name="permission[company][company_detail]" data-checkem-parent="permission[company]"
                            {{ (json_decode($user->permission) && in_array('company_detail', json_decode($user->permission, true)['company'] ?? [])) ? 'checked' : '' }} />
                        <label class="form-check-label" for="company_detail">Company Detail</label>
                    </div>
                </li>
                <li class="col-4">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="company_create" id="company_create" name="permission[company][company_create]" data-checkem-parent="permission[company]"
                            {{ (json_decode($user->permission) && in_array('company_create', json_decode($user->permission, true)['company'] ?? [])) ? 'checked' : '' }} />
                        <label class="form-check-label" for="company_create">Company Create</label>
                    </div>
                </li>
                <li class="col-4">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="company_edit" id="company_edit" name="permission[company][company_edit]" data-checkem-parent="permission[company]"
                            {{ (json_decode($user->permission) && in_array('company_edit', json_decode($user->permission, true)['company'] ?? [])) ? 'checked' : '' }} />
                        <label class="form-check-label" for="company_edit">Company Edit</label>
                    </div>
                </li>
                <li class="col-4">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="company_status" id="company_status" name="permission[company][company_status]" data-checkem-parent="permission[company]"
                            {{ (json_decode($user->permission) && in_array('company_status', json_decode($user->permission, true)['company'] ?? [])) ? 'checked' : '' }} />
                        <label class="form-check-label" for="company_status">Company Status</label>
                    </div>
                </li>
                <li class="col-4">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="company_delete" id="company_delete" name="permission[company][company_delete]" data-checkem-parent="permission[company]"
                            {{ (json_decode($user->permission) && in_array('company_delete', json_decode($user->permission, true)['company'] ?? [])) ? 'checked' : '' }} />
                        <label class="form-check-label" for="company_delete">Company Delete</label>
                    </div>
                </li>
            </ul>

        </div>
    </div>
</div>
