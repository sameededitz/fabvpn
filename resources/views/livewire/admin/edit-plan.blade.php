<div>
    <div class="row">
        <div class="col-xl-12 ">
            <h6 class="mb-0 text-uppercase">Edit Plan</h6>
            <hr />
            <div class="card">
                <form  wire:submit.prevent="update">
                <div class="card-body">
                    <label for="name" class="form-label">Name</label>
                    <input class="form-control mb-3" type="text" wire:model="name" placeholder="Name" aria-label="default input example"
                        name="name" id="name">
                        @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <label for="name" class="form-label">Description</label>
                    <input class="form-control mb-3" type="text" wire:model="description" placeholder="Description"
                        aria-label="default input example" name="name" id="name">
                        @error('description')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <label for="name" class="form-label">Price</label>
                    <input class="form-control mb-3" type="text"  wire:model="price" placeholder="Price"
                        aria-label="default input example" name="name" id="name">
                        @error('price')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <label for="name" class="form-label">Duration</label>
                    <input class="form-control mb-3" type="text" wire:model="duration" placeholder="Duration"
                        aria-label="default input example" name="name" id="name">
                        @error('duration')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <label for="name" class="form-label">Duration Unit</label>
                    <select class="form-select mb-3" id="type" wire:model="duration_unit" aria-label="Default select example">
                        <option value="" selected>Select Unit</option>
                        <option value="day">Day</option>
                        <option value="week">Week</option>
                        <option value="month">Month</option>
                        <option value="year">Year</option>
                    </select>
                    @error('duration_unit')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <button type="submit" class="btn btn-light px-5">Update</button>
                </div>
            </form>
        </div>
        </div>
    </div>
</div>
