<div class="card border-0 shadow rounded-lg mb-3">
    <div class="card-body">
        <form wire:submit.prevent="login">
            <div class="form-group">
                <label>Email Address</label>
            <input type="text" wire:model.lazy="email"  value="{{old('email')}}" class="form-control @error('email') is-invalid @enderror"  placeholder="Email Address">
                @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" wire:model.lazy="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password">
                @error('password') 
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary btn-sm">LOGIN</button>
        </form>
    </div>
</div> 
