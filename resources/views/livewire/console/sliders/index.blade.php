<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card border-0 shadow rounded-lg">
            <div class="card-header">
                <i class="fa fa-laptop"></i> SLIDERS
            </div>
            <div class="card-body">
                <div class="table-responsive mt-3">
                    <table class="table table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">NO.</th>
                                <th scope="col">IMAGE</th>
                                <th scope="col">OPTIONS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($slider as $s)
                            <tr>
                                <th class="text-center" scope="row">
                                    {{ $loop->iteration }}</th>
                                <td class="text-center">
                                    <img src="{{ Storage::url('public/sliders/'.$s->image) }}" class="w-100 rounded" style="height: 200px">
                                
                                    <p class="mt-2">{{ $s->link }}</p>
                                </td>
                                <td class="text-center">
                                    <button wire:click="destroy({{ $s->id }})"
                                        class="btn btn-sm btn-danger">DELETE</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $slider->links() }}
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow rounded-lg">
            <div class="card-header">
                <i class="fa fa-image"></i> UPLOAD SLIDER
            </div>
            <div class="card-body">
                @if($image)
                <div class="text-center">
                    <img src="{{ $image->temporaryUrl() }}" alt="" style="height: 250px;width:100%;object-fit:cover"
                        class="img-thumbnail">
                    <p>PREVIEW</p>
                </div>
                @else
                <div class="text-center">
                    <img src="{{ asset('images/image.png') }}" alt="" style="height: 250px;width:100%;object-fit:cover"
                        class="img-thumbnail">
                    <p>PREVIEW</p>
                </div>
                @endif
                <hr>
                <form wire:submit.prevent="store">
                    <div class="form-group">
                        <input type="file" id="image" class="form-control" wire:model="image">
                        @error('image')
                        <div class="invalid-feedback d-block">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Link Slider</label>
                        <input type="text" class="form-control" wire:model.lazy="link" placeholder="Link Slider">
                        @error('link')
                        <div class="invalid-feedback d-block">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary btn-block mt-4">UPLOAD</button>
                </form>

            </div>
        </div>
    </div>
</div>
