<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card border-0 shadow rounded-lg">
            <div class="card-header">
                <i class="fa fa-shopping-cart"></i> ORDERS
            </div>
            <div class="card-body">


                <form action="" method="GET">
                    <div class="input-group">
                        <input type="text" wire:model="search" placeholder="cari sesuatu disini..." class="form-control">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-dark"><i class="fa fa-search"></i> SEARCH
                            </button>
                        </div>
                    </div>
                </form>

                <div class="table-responsive mt-3">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th scope="col" style="text-align: center;width: 6%">NO.</th>
                            <th scope="col">NO. INVOICE</th>
                            <th scope="col">GRAND TOTAL</th>
                            <th scope="col">STATUS</th>
                            <th scope="col" class="text-center">DATE</th>
                            <th scope="col" style="width: 17%;text-align: center">AKSI</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($invoice as $i)
                            <tr>
                                <th scope="row" style="text-align: center">{{ $loop->iteration }}</th>
                                <td>{{ $i->invoice }}</td>
                                <td class="text-right">{{ money_id($i->grand_total) }}</td>
                                <td class="text-center">
                                    @if ($i->status == "pending")
                                        <button class="btn btn-sm btn-danger"><i class="fa fa-circle-notch fa-spin"></i> {{ $i->status }}</button>
                                    @elseif($i->status == "payment_review")
                                        <button class="btn btn-sm btn-warning"><i class="fa fa-spinner fa-spin"></i> {{ $i->status }}</button>
                                    @elseif($i->status == "payment_invalid")
                                        <button class="btn btn-sm btn-danger"><i class="fa fa-times-circle"></i> {{ $i->status }}</button>
                                    @elseif($i->status == "progress")
                                        <button class="btn btn-sm btn-info"><i class="fa fa-hourglass-start"></i> {{ $i->status }}</button>
                                    @elseif($i->status == "shipping")
                                        <button class="btn btn-sm btn-primary"><i class="fa fa-truck"></i> {{ $i->status }}</button>
                                    @elseif($i->status == "done")
                                        <button class="btn btn-sm btn-success"><i class="fa fa-check-circle"></i> {{ $i->status }}</button>
                                    @endif
                                </td>
                                <td>{{ TanggalID("j M Y", $i->created_at) }}</td>
                                <td class="text-center">
                                    <a href="{{ route('console.orders.show', $i->id) }}" class="btn btn-sm btn-primary">
                                        <i class="fa fa-list-ul"></i>
                                    </a>
                                    <a href="{{ route('console.orders.status', $i->id) }}" class="btn btn-sm btn-success">
                                        <i class="fa fa-exchange-alt"></i>
                                    </a>
                                    <a href="{{ route('console.orders.receipt', $i->id) }}" class="btn btn-sm btn-warning">
                                        <i class="fa fa-truck"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div style="text-align: center">
                        {{ $invoice->links() }}
                    </div>
                </div>
            </div>

            </div>
        </div>
    </div>
</div>
