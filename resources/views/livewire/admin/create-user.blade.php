<div>
    <div class="row">
        <div class="col-xl-12">
            <h6 class="mb-0 text-uppercase">Create User</h6>
            <hr />
            <div class="card">
                <div class="card-body">
                    <div class="mb-3" wire:submit.prevent="store">
                        <label for="name" class="form-label">Image</label>
                        <div class="multiple-file-upload">
                            <input class="form-control" type="file" id="formFile">
                        </div>
                    </div>
                    <input class="form-control mb-3" type="text" placeholder="Name" aria-label="default input example"
                        name="name" id="name" wire:model="name">
                    <select class="form-select mb-3" id="type" wire:model="type" aria-label="Default select example">
                        <option value="" selected>Server Type</option>
                        <option value="free">Free</option>
                        <option value="premium">Premium</option>
                    </select>
                    <select class="form-select mb-3" id="status" wire:model="status" aria-label="Default select example">
                        <option value="" selected>Select Status</option>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                    <input class="form-control mb-3" id="name" name="longitude" wire:model="longitude" type="text"
                        placeholder="Longitude" aria-label="default input example">
                    <input class="form-control mb-3" id="name" name="Latitude" wire:model="Latitude" type="text"
                        placeholder="Latitude" aria-label="default input example">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="form-custom-switch-success"
                            wire:model="android">
                        <label class="form-check-label" for="flexSwitchCheckDefault">Android</label>
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" role="switch" type="checkbox" id="form-custom-switch-success"
                            wire:model="ios">
                        <label class="form-check-label" for="flexSwitchCheckDefault">IOS</label>
                    </div>
                    <button type="submit" class="btn btn-light px-5">Create</button>
                </div>
            </div>
        </div>
    </div>   
</div>
