<div style="margin-top: -120px">
    <div class="container-fluid mb-lg-5 mt-4">
        <div class="row">
            <div class="col-md-3">
                <div class="card border-0 shadow rounded-lg mb-4">
                    <div class="card-body p-3">
                        <h6 class="font-weight-bold"><i class="fa fa-list-ul"></i> MAIN MENU</h6>
                        <hr>
                        @include('layouts.customer_menu')
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card border-0 shadow rounded-lg">
                    <div class="card-body">
                        <h6 class="font-weight-bold"><i class="fa fa-shopping-cart"></i> MY ORDERS</h6>
                        <hr>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col" class="text-center" style="text-align: center;width: 6%">NO.
                                        </th>
                                        <th scope="col" class="text-center">INVOICE</th>
                                        <th scope="col" class="text-center">GRAND TOTAL</th>
                                        <th scope="col" class="text-center">STATUS</th>
                                        <th scope="col" class="text-center" style="width: 15%;text-align: center">
                                            OPTIONS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($invoice as $i)
                                    <tr>
                                        <th scope="row" style="text-align: center">
                                            {{ $loop->iteration }}</th>
                                        <td>{{ $i->invoice }}</td>
                                        <td class="text-right">{{ money_id($i->grand_total) }}</td>
                                        <td class="text-center">
                                            @if ($i->status == "pending")
                                            <button class="btn btn-sm btn-danger"><i
                                                    class="fa fa-circle-notch fa-spin"></i>
                                                {{ $i->status }}</button>
                                            @elseif($i->status == "payment_review")
                                            <button class="btn btn-sm btn-warning"><i class="fa fa-spinner fa-spin"></i>
                                                {{ $i->status }}</button>
                                            @elseif($i->status == "ppayment_invalid")
                                            <button class="btn btn-sm btn-danger"><i class="fa fa-times-circle"></i>
                                                {{ $i->status }}</button>
                                            @elseif($i->status == "progress")
                                            <button class="btn btn-sm btn-info"><i class="fa fa-hourglass-start"></i>
                                                {{ $i->status }}</button>
                                            @elseif($i->status == "shipping")
                                            <button class="btn btn-sm btn-primary"><i class="fa fa-truck"></i>
                                                {{ $invoice->status }}</button>
                                            @elseif($i->status == "done")
                                            <button class="btn btn-sm btn-success"><i class="fa fa-check-circle"></i>
                                                {{ $i->status }}</button>
                                            @endif
                                        </td>
                                        <td class="text-center" style="width: 20%">
                                            <a href="{{ route('customer.orders.show', $i->id) }}"
                                                data-toggle="tooltip" data-placement="top" title="Detail"
                                                class="btn btn-sm btn-primary">
                                                <i class="fa fa-list-ul"></i>
                                            </a>
                                            @if ($i->status == "pending" || $i->status ==
                                            "payment_invalid")
                                            <a href="{{ route('frontend.payment.index', $i->invoice) }}"
                                                data-toggle="tooltip" data-placement="top" title="Konfirmasi Pembayaran"
                                                class="btn btn-sm btn-success">
                                                <i class="fa fa-credit-card"></i>
                                            </a>
                                            @endif
                                            @if ($i->no_resi != "")
                                            <span data-toggle="tooltip" data-placement="top"
                                                title="Tracking Order Progress">
                                                <button data-courier="{{ strtolower($i->courier) }}"
                                                    data-resi="{{ $i->no_resi }}"
                                                    class="btn btn-tracking btn-sm btn-primary">
                                                    <i class="fa fa-truck"></i>
                                                </button>
                                            </span>
                                            @endif
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
</div>

<!-- Modal Tracking -->
<div class="modal fade" id="tracking" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-truck"></i> TRACKING STATUS</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <h6 class="font-weight-bold"><i class="fa fa-info-circle"></i> IINFORMATION SHIPPING</h6>
                    <table class="table table-bordered">
                        <tr>
                            <td class="w-25">STATUS</td>
                            <td>
                                <div class="font-weight-bold" id="status"></div>
                            </td>
                        </tr>
                        <tr>
                            <td class="w-25">NO. RESI</td>
                            <td>
                                <div class="font-weight-bold" id="no_resi"></div>
                            </td>
                        </tr>
                        <tr>
                            <td class="w-25">COURIER</td>
                            <td>
                                <div class="font-weight-bold" id="courier"></div>
                            </td>
                        </tr>
                        <tr>
                            <td class="w-25">SERVICE</td>
                            <td>
                                <div class="font-weight-bold" id="service"></div>
                            </td>
                        </tr>
                        <tr>
                            <td class="w-25">DELIVERY TO</td>
                            <td>
                                <div class="font-weight-bold" id="receiver_address"></div>
                            </td>
                        </tr>
                    </table>

                    <h6 class="font-weight-bold mt-4"><i class="fa fa-truck"></i> INFORMATION STATUS TRACKING </h6>
                    <table class="table table-bordered" id="detail-tracking"></table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
            </div>
        </div>
    </div>
</div>

<script>
    $('.btn-tracking').click(function () {

        let courier = $(this).data('courier');
        let no_resi = $(this).data('resi');
        let token = $("meta[name='csrf-token']").attr("content");

        $.ajax({
            url: "/waybill",
            data: {
                _token: token,
                courier: courier,
                no_resi: no_resi,
            },
            type: "POST",
            dataType: "json",
            success: function (response) {
                console.log(response);

                //append on html modal
                $('#status').html(response.data.delivery_status.status);
                $('#no_resi').html(no_resi);
                $('#courier').html(courier.toUpperCase());
                $('#service').html(response.data.courier.service_code);
                $('#receiver_address').html(response.data.waybill.receiver_address);

                //detail tracking
                $.each(response.data.details, function (key, value) {
                    $('#detail-tracking').append('<tr>' +
                        '<td class="w-25">' +
                        value.shipping_date + ' ' + value.shipping_time +
                        '</td>' +
                        '<td>' +
                        value.shipping_description + '[' + value.city_name + ']' +
                        '</td>' +
                        '</tr>');
                });
                $("#tracking").modal('show');
            }
        });


    })
</script>
