<div style="margin-top: 100px">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="text-center mb-4">
                    <h3 class="font-weight-bold mt-2"><i class="fa fa-lock"></i> LOGIN ACCOUNT</h3>
                    <p>
                        Or <a href="/customer/register" class="text-dark"><u> register for new account</u></a>
                    </p>
                </div>
                <div class="card border-0 shadow rounded-lg mb-3">
                    <div class="card-body">
                        <form wire:submit.prevent="login">
                            <div class="form-group">
                                <label>Email Address</label>
                                <input type="text" wire:model.lazy="email" class="form-control @error('email') is-invalid @enderror"
                                    placeholder="Email Address">
                                @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" wire:model.lazy="password"
                                    class="form-control @error('password') is-invalid @enderror" placeholder="Password">
                                @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary btn-block shadow">LOGIN</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
