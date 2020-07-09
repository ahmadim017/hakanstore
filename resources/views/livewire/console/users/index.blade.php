<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card border-0 shadow rounded-lg">
            <div class="card-header">
                <i class="fa fa-users"></i> USERS
            </div>
            <div class="card-body">
                @if(session()->has('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @elseif(session()->has('error'))
                        <div class="alert alert-danger">
                        {{ session('error') }}
                        </div>
                    @endif
                <form action="" method="GET">
                    <div class="input-group">
                        <div class="input-group-append">
                            <a href="{{ route('console.users.create') }}" class="btn btn-dark"><i
                                    class="fa fa-plus-circle"></i>
                                ADD
                            </a>
                        </div>
                        <input type="text" wire:model="search" placeholder="cari sesuatu disini..." class="form-control">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-dark"><i class="fa fa-search"></i> SEARCH
                            </button>
                        </div>
                    </div>
                </form>

                <div class="table-responsive mt-3">
                    <table class="table table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">NO.</th>
                                <th scope="col">EMAIL ADDRESS</th>
                                <th scope="col">FULL NAME</th>
                                <th scope="col">OPTIONS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($user as $u)
                            <tr>
                                <th class="text-center" scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $u->email }}</td>
                                <td>{{ $u->name }}</td>
                                <td class="text-center">
                                    <a href="{{ route('console.users.edit', $u->id) }}"
                                        class="btn btn-sm btn-primary">EDIT</a>
                                    <button wire:click="destroy({{ $u->id }})" class="btn btn-sm btn-danger">DELETE</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $user->links() }}
                </div>

            </div>
        </div>
    </div>
</div>
