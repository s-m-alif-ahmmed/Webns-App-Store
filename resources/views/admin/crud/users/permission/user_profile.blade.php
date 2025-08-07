<div class="accordion-item">
    <h2 class="accordion-header">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#users_profile" aria-expanded="true" aria-controls="users_profile">
            <label class="form-check-label" for="users_profile">User Profile</label>
        </button>
    </h2>
    <div id="users_profile" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
        <div class="accordion-body">

            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="user_profile" value="user_profile" name="permission[user_profile]"
                    {{--                                                            {{ (json_decode($user->permission) && in_array('user_profile', json_decode($user->permission, true) ?? [])) ? 'checked' : '' }} --}}
                />
                <label class="form-check-label" for="user_profile">User Profile</label>
            </div>

            <ul class="row d-flex col-12">
                <li class="col-4">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="profile_setting" id="profile_setting" name="permission[user_profile][profile_setting]" data-checkem-parent="permission[user_profile]"
                            {{ (json_decode($user->permission) && in_array('profile_setting', json_decode($user->permission, true)['user_profile'] ?? [])) ? 'checked' : '' }} />
                        <label class="form-check-label" for="profile_setting">Setting/Change Password</label>
                    </div>
                </li>
                <li class="col-4">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="profile_edit" id="profile_edit" name="permission[user_profile][profile_edit]" data-checkem-parent="permission[user_profile]"
                            {{ (json_decode($user->permission) && in_array('profile_edit', json_decode($user->permission, true)['user_profile'] ?? [])) ? 'checked' : '' }} />
                        <label class="form-check-label" for="profile_edit">Profile Edit</label>
                    </div>
                </li>
                <li class="col-4">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="profile_email" id="profile_email" name="permission[user_profile][profile_email]" data-checkem-parent="permission[user_profile]"
                            {{ (json_decode($user->permission) && in_array('profile_email', json_decode($user->permission, true)['user_profile'] ?? [])) ? 'checked' : '' }} />
                        <label class="form-check-label" for="profile_email">Email</label>
                    </div>
                </li>
                <li class="col-4">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="profile_phone" id="profile_phone" name="permission[user_profile][profile_phone]" data-checkem-parent="permission[user_profile]"
                            {{ (json_decode($user->permission) && in_array('profile_phone', json_decode($user->permission, true)['user_profile'] ?? [])) ? 'checked' : '' }} />
                        <label class="form-check-label" for="user_phone">Phone Number</label>
                    </div>
                </li>
                <li class="col-4">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="employee_id" id="employee_id" name="permission[user_profile][employee_id]" data-checkem-parent="permission[user_profile]"
                            {{ (json_decode($user->permission) && in_array('employee_id', json_decode($user->permission, true)['user_profile'] ?? [])) ? 'checked' : '' }} />
                        <label class="form-check-label" for="employee_id">Employee ID</label>
                    </div>
                </li>
                <li class="col-4">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="profile_department" id="profile_department" name="permission[user_profile][profile_department]" data-checkem-parent="permission[user_profile]"
                            {{ (json_decode($user->permission) && in_array('profile_department', json_decode($user->permission, true)['user_profile'] ?? [])) ? 'checked' : '' }} />
                        <label class="form-check-label" for="profile_department">Department</label>
                    </div>
                </li>
                <li class="col-4">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="profile_designation" id="profile_designation" name="permission[user_profile][profile_designation]" data-checkem-parent="permission[user_profile]"
                            {{ (json_decode($user->permission) && in_array('profile_designation', json_decode($user->permission, true)['user_profile'] ?? [])) ? 'checked' : '' }} />
                        <label class="form-check-label" for="profile_designation">Designation</label>
                    </div>
                </li>
            </ul>

        </div>
    </div>
</div>
