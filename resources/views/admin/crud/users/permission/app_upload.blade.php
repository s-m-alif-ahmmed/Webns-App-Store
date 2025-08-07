<div class="accordion-item">
    <h2 class="accordion-header">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#app_up" aria-expanded="true" aria-controls="app_up">
            <label class="form-check-label" for="app_up">App Upload</label>
        </button>
    </h2>
    <div id="app_up" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
        <div class="accordion-body">

            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="app_upload" value="app_upload" name="permission[app_upload]" />
                <label class="form-check-label" for="app_upload">App Upload</label>
            </div>

            <ul class="row d-flex col-12">
                <li class="col-4">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="app_upload_manage" id="app_upload_manage" name="permission[app_upload][app_upload_manage]" data-checkem-parent="permission[app_upload]"
                            {{ (json_decode($user->permission) && in_array('app_upload_manage', json_decode($user->permission, true)['app_upload'] ?? [])) ? 'checked' : '' }} />
                        <label class="form-check-label" for="app_upload_manage">App Upload Manage</label>
                    </div>
                </li>
                <li class="col-4">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="app_upload_detail" id="app_upload_detail" name="permission[app_upload][app_upload_detail]" data-checkem-parent="permission[app_upload]"
                            {{ (json_decode($user->permission) && in_array('app_upload_detail', json_decode($user->permission, true)['app_upload'] ?? [])) ? 'checked' : '' }} />
                        <label class="form-check-label" for="app_upload_detail">App Upload Detail</label>
                    </div>
                </li>
                <li class="col-4">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="app_upload_create" id="app_upload_create" name="permission[app_upload][app_upload_create]" data-checkem-parent="permission[app_upload]"
                            {{ (json_decode($user->permission) && in_array('app_upload_create', json_decode($user->permission, true)['app_upload'] ?? [])) ? 'checked' : '' }} />
                        <label class="form-check-label" for="app_upload_create">App Upload Create</label>
                    </div>
                </li>
                <li class="col-4">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="app_upload_edit" id="app_upload_edit" name="permission[app_upload][app_upload_edit]" data-checkem-parent="permission[app_upload]"
                            {{ (json_decode($user->permission) && in_array('app_upload_edit', json_decode($user->permission, true)['app_upload'] ?? [])) ? 'checked' : '' }} />
                        <label class="form-check-label" for="app_upload_edit">App Upload Edit</label>
                    </div>
                </li>

                <li class="col-4">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="apk_app_download" id="apk_app_download" name="permission[app_upload][apk_app_download]" data-checkem-parent="permission[app_upload]"
                            {{ (json_decode($user->permission) && in_array('apk_app_download', json_decode($user->permission, true)['app_upload'] ?? [])) ? 'checked' : '' }} />
                        <label class="form-check-label" for="apk_app_download">APK App Download</label>
                    </div>
                </li>
                <li class="col-4">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="apk_app_status" id="apk_app_status" name="permission[app_upload][apk_app_status]" data-checkem-parent="permission[app_upload]"
                            {{ (json_decode($user->permission) && in_array('apk_app_status', json_decode($user->permission, true)['app_upload'] ?? [])) ? 'checked' : '' }} />
                        <label class="form-check-label" for="apk_app_status">Apk App Status</label>
                    </div>
                </li>
                <li class="col-4">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="app_upload_status" id="app_upload_status" name="permission[app_upload][app_upload_status]" data-checkem-parent="permission[app_upload]"
                            {{ (json_decode($user->permission) && in_array('app_upload_status', json_decode($user->permission, true)['app_upload'] ?? [])) ? 'checked' : '' }} />
                        <label class="form-check-label" for="app_upload_status">App Upload Status</label>
                    </div>
                </li>
                <li class="col-4">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="app_upload_delete" id="app_upload_delete" name="permission[app_upload][app_upload_delete]" data-checkem-parent="permission[app_upload]"
                            {{ (json_decode($user->permission) && in_array('app_upload_delete', json_decode($user->permission, true)['app_upload'] ?? [])) ? 'checked' : '' }} />
                        <label class="form-check-label" for="app_upload_delete">App Upload Delete</label>
                    </div>
                </li>
            </ul>

        </div>
    </div>
</div>
