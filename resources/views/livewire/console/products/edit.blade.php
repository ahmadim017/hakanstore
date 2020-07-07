<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card border-0 shadow rounded-lg">
            <div class="card-header">
                <i class="fa fa-shopping-bag"></i> EDIT PRODUCT
            </div>
            <div class="card-body">
                <form wire:submit.prevent="update">
                    <input type="hidden" wire:model="productId">
                    <div class="row">
                        <div class="col-md-12">
                            @if($image)
                            <div class="text-center">
                                <img src="{{ $image->temporaryUrl() }}" alt="" style="height: 150px;width:150px;object-fit:cover"
                                    class="img-thumbnail">
                                <p>PREVIEW</p>
                            </div>
                            @else
                            <div class="text-center">
                                <img src="{{ asset('images/image.png') }}" alt=""
                                    style="height: 150px;width:150px;object-fit:cover" class="img-thumbnail">
                                <p>PREVIEW</p>
                            </div>
                            @endif


                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Image</label>
                                <input type="file" id="image" class="form-control" wire:model="image">
                                @error('image')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tittle</label>
                                <input type="text" wire:model.lazy="tittle"
                                    class="form-control @error('tittle') is-invalid @enderror"
                                    placeholder="Tittle Product">
                                @error('tittle')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group" wire:ignore>
                                <label>Category</label>
                                <select class="select2 form-control @error('category_id') is-invalid @enderror"
                                    wire:model.lazy="category_id">
                                    <option value="">-- select category --</option>
                                    @foreach ($categories as $row)
                                    @if($category_id == $row->id)
                                    <option value="{{ $row->id  }}" selected>{{ $row->name }}</option>
                                    @else
                                    <option value="{{ $row->id  }}">{{ $row->name }}</option>
                                    @endif
                                    @endforeach
                                </select>
                                @error('category_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Weight</label>
                                <input type="number" wire:model.lazy="weight"
                                    class="form-control @error('weight') is-invalid @enderror"
                                    placeholder="Weight Product">
                                @error('weight')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row" wire:ignore>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Content Product</label>
                                <textarea class="form-control @error('content') is-invalid @enderror" rows="6"
                                    wire:model.lazy="content" placeholder="Content" id="content">{{ $content }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Unit</label>
                                <input type="text" wire:model.lazy="unit"
                                    class="form-control @error('unit') is-invalid @enderror"
                                    placeholder="Unit Product, Exp: gram, kg">
                                @error('unit')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Unit Weight</label>
                                <input type="number" wire:model.lazy="unit_weight"
                                    class="form-control @error('unit_weight') is-invalid @enderror"
                                    placeholder="Unit Weight Product">
                                @error('unit_weight')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Price</label>
                                <input type="number" wire:model.lazy="price"
                                    class="form-control @error('price') is-invalid @enderror"
                                    placeholder="Price Product">
                                @error('price')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Discount (%)</label>
                                <input type="number" wire:model.lazy="discount"
                                    class="form-control @error('discount') is-invalid @enderror"
                                    placeholder="Discount Product (%)">
                                @error('discount')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Keywords</label>
                                <input type="text" wire:model.lazy="keywords"
                                    class="form-control @error('keywords') is-invalid @enderror"
                                    placeholder="Keywords Product">
                                @error('keywords')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" rows="4"
                                    wire:model.lazy="description"
                                    placeholder="Description">{{ $description }}</textarea>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">UPDATE</button>
                    <button type="reset" class="btn btn-warning">RESET</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        //category
        $('.select2').select2({
                theme: 'bootstrap4',
                width:'style'
        });
        $('.select2').on('change', function (e) {
            @this.set('category_id', e.target.value);       
        });
    });
</script>
<script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('content').on('change', function(e){
        @this.set('content', e.editor.getData());
    });
</script>
