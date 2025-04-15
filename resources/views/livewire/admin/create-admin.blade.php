<div>
    <div class="row">
        <div class="col-xl-12">
            <h6 class="mb-0 text-uppercase">Create User</h6>
            <hr />
            <div class="card">
                <form wire:submit.prevent="store">
                    <div class="card-body">
                        <label for="name" class="form-label">Name</label>
                        <input class="form-control mb-3" type="text" placeholder="Name"
                            aria-label="default input example" name="name" id="name" wire:model="name">
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <label for="name" class="form-label">Email</label>
                        <input class="form-control mb-3" type="text" placeholder="Name"
                            aria-label="default input example" name="name" id="name" wire:model="email">
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <label for="name" class="form-label">Password</label>
                        <input type="password" class="form-control mb-3" id="password" wire:model="password"
                            placeholder="Enter Password">
                        @error('password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <label for="name" class="form-label">Confirm Password</label>
                        <input type="password_confirmation" class="form-control mb-3" id="password_confirmation"
                            wire:model="password_confirmation" placeholder="Confirm Password">
                            @error('password_confirmation')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <label for="name" class="form-label">Role</label>
                        <select class="form-select mb-3" id="status" wire:model="role" aria-label="Default select example">
                            <option value="" selected>Select role</option>
                            <option value="user">User</option>
                            <option value="admin">Admin</option>
                        </select>
                        @error('role')
                            <div class="text-danger">{{ $message }}</div>
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                        <button type="submit" class="btn btn-light px-5">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
