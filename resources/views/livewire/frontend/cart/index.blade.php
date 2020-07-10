<div class="mb-5">
    <div class="container-fluid mb-lg-5" style="margin-top: 80px;">

        <div class="row mt-4 mb-4 justify-content-center">
            <div class="col-md-6 mb-4">
                <div class="card border-0 shadow rounded-md">
                    <div class="card-body">
                        <h5><i class="fa fa-shopping-cart"></i> DETAIL PESENAN</h5>
                        <hr>
                        @php
                        $totalPrice = 0;
                        $weight = 0;
                        @endphp
                        <table class="table"
                            style="border-style: solid !important;border-color: rgb(198, 206, 214) !important;">
                            <tbody>
                                @foreach($cart['products'] as $product)

                                @php
                                $harga_set = $product->price * $product->discount / 100;
                                $harga_diskon = $product->price - $harga_set;
                                @endphp

                                <tr style="background: #edf2f7;">
                                    <td class="b-none" width="25%">
                                        <div class="wrapper-image-cart">
                                            <img src="{{ Storage::url('public/products/'.$product->image) }}"
                                                style="width: 100%;border-radius: .5rem">
                                        </div>
                                    </td>
                                    <td class="b-none" width="50%">
                                        <h5><b>{{ $product->title }}</b></h5>
                                        <table class="table-borderless" style="font-size: 14px">
                                            <tr>
                                                <td style="padding: .20rem">PRICE</td>
                                                <td style="padding: .20rem">:</td>
                                                <td style="padding: .20rem">{{ money_id($harga_diskon) }}</td>
                                            </tr>
                                            <tr>
                                                <td style="padding: .20rem">Berat</td>
                                                <td style="padding: .20rem">:</td>
                                                <td style="padding: .20rem"><b>{{ $product->unit_weight }}
                                                        {{ $product->unit }}</b></td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td class="b-none text-right">
                                        <div class="text-right">
                                            <button wire:click="removeCart({{ $product->id }})"
                                                class="btn btn-sm shadow btn-danger rounded-full">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>


                                @php
                                $totalPrice += $harga_diskon;
                                $weight += $product->weight;
                                @endphp

                                @endforeach

                            </tbody>
                        </table>

                        <table class="table table-default">
                            <tbody>
                                <tr>
                                    <td class="set-td text-left" width="60%">
                                        <p class="m-0">TOTAL </p>
                                    </td>
                                    <td class="set-td  text-right" width="30%">&nbsp; : Rp.</td>
                                    <td class="text-right set-td ">
                                        <p class="m-0" id="subtotal"> {{ number_format($totalPrice, '0', '', '.') }}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="set-td text-left border-0" width="60%">
                                        <p class="m-0">DISCOUNT </p>
                                    </td>
                                    <td class="set-td  text-right border-0" width="30%">&nbsp; : Rp.</td>
                                    <td class="text-right border-0 set-td ">
                                        <p class="m-0" id="diskon"> 0</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="set-td text-left border-0">
                                        <p class="m-0">SHIPPING (<strong>{{ $weight }}</strong> {{ $product->unit }})</p>
                                    </td>
                                    <td class="set-td border-0 text-right">&nbsp; : Rp.</td>
                                    <td class="set-td border-0 text-right">
                                        <p class="m-0" id="ongkir-cart">0</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td class=" text-left border-0">
                                        <p class="font-weight-bold m-0 h5 text-uppercase">GRAND TOTAL </p>
                                    </td>
                                    <td class=" border-0 text-right">&nbsp; : Rp.</td>
                                    <td class=" border-0 text-right">
                                        <p class="font-weight-bold m-0 h5" id="grand-total" align="right">0</p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>


                        <div class="d-none">
                            <p id="ongkir-cart-hidden"></p>
                            <p id="diskon-hidden"></p>
                            <p id="ongkir-service-hidden"></p>
                            <p id="grand-total-hidden"></p>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-6">
                @if (Auth::guard('customer')->check())

                <div class="card border-0 shadow rounded-md">
                    <div class="card-body">
                        <h5><i class="fa fa-user-circle"></i> LENGKAPI DATA PENGIRIMAN</h5>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold">NAMA LENGKAP</label>
                                    <input type="text" class="form-control" id="nama_lengkap"
                                        placeholder="Nama Lengkap">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold">NO. HP / WHATSAPP</label>
                                    <input type="number" class="form-control" id="phone"
                                        placeholder="No. HP / WhatsApp">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">PROVINSI</label>
                            <select class="form-control select-provinsi" name="provinsi">
                                <option value="">-- pilih provinsi --</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">KOTA / KABUPATEN</label>
                            <select class="form-control select-kota" name="kota">
                                <option value="">-- pilih kota --</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">KECAMATAN</label>
                            <select class="form-control select-kecamatan" name="kecamatan">
                                <option value="">-- pilih kecamatan --</option>
                            </select>
                        </div>
                        <div class="form-group d-none" id="courier">


                        </div>
                        <hr>
                        <div class="form-group d-none" id="ongkir">

                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">ALAMAT LENGKAP</label>
                            <textarea class="form-control" id="alamat" rows="3"
                                placeholder="Alamat Lengkap&#10;&#10;Contoh: Perum. Griya Palem Indah, B-17 Jombang Jawa Timur 61419"></textarea>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">CATATAN</label>
                            <textarea class="form-control" id="catatan" rows="2"
                                placeholder="Catatan Tambahan"></textarea>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-12">
                        <a class="font-weight-bold text-dark" href="" target="_blank"><i class="fa fa-info-circle"></i>
                            Lihat Promo Hari ini Disini</a>
                    </div>

                    <div class="col-md-12">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="voucher" placeholder="Masukkan Kode Voucher">
                            <div class="input-group-append">
                                <a data-rules="add" href="javascript:void(0);"
                                    class="btn-voucher btn btn-dark shadow btn-md btn-block">VALIDASI</a>
                            </div>
                        </div>
                    </div>
                </div>

                <button class="btn btn-lg btn-dark shadow mt-3 btn-block btn-checkout">CHECKOUT
                </button>

                @else

                <div class="card border-0 shadow rounded-md">
                    <div class="card-body">
                        <h5><i class="fa fa-user-circle"></i> SILAHKAN MASUK / DAFTAR</h5>
                        <hr>
                        <a href="{{ route('customer.auth.login') }}" class="btn btn-dark btn-block btn-lg shadow"><i
                                class="fa fa-user-circle"></i> LOGIN / REGISTER</a>
                    </div>
                </div>

                @endif

            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $(".select-provinsi, .select-kota, .select-kecamatan").select2({
            thema: 'bootsrap4',
            width: 'style',
        });
    });

    $(document).ready(function () {
        
        let grandTotal = "{{$totalPrice}}";
        let diskon = parseInt($('#diskon-hidden').text()) || 0;

        $('#grand-total').html(money_id(parseInt(grandTotal) - parseInt(diskon)));
        $('#grand_total-hidden').html(money_id(parseInt(grandTotal) - parseInt(diskon)));
    });

    function money_id(angka)
    {
        let reverse = angka.toString().split('').reverse().join(''),
            ribuan = reverse.match(/\d{1,3}/g);
            ribuan = ribuan.join('.').split('').reverse().join('');
            return ribuan;
    }

    $(document).ready(function (){
        jQuery.ajax({
            url : '/provinces',
            type : "GET",
            dataType : 'json',
            success: function (response){
                $.each(response.data.results, function (key, value) {
                    $('select[name ="provinsi"]').append('<option value="' + value.id +'">' + value.name +'</option>');
                });
            },
        });
    });

    $(document).ready(function () {

$('select[name="provinsi"]').on('change', function () {

    //clear ongkir
    $('#ongkir-cart').html(0);
    $('#ongkir-cart-hidden').html(0);
    $('#ongkir-service-hidden').html(0);

    //hide ongkir
    $('#ongkir').addClass('d-none');

    //set grand total ke default
    let grandTotal = "{{ $totalPrice }}";
    let diskon = parseInt($('#diskon-hidden').text()) || 0;

    $('#grand-total').html(money_id(parseInt(grandTotal) - parseInt(diskon)));
    $('#grand-total-hidden').html(parseInt(grandTotal) - parseInt(diskon));

    let provinceId = $(this).val();
    if (provinceId) {
        jQuery.ajax({
            url: '/cities',
            type: "GET",
            dataType: "json",
            data: {
                province: provinceId
            },
            success: function (response) {
                $('select[name="kota"]').empty();
                $('select[name="kota"]').append(
                    '<option value="">-- pilih kota --</option>');
                $('select[name="kecamatan"]').empty();
                $('select[name="kecamatan"]').append(
                    '<option value="">-- pilih kecamatan --</option>');
                $.each(response.data.results, function (key, value) {
                    $('select[name="kota"]').append('<option value="' +
                        value.id + '">' + value.name + '</option>');
                });
            },
        });
    } else {
        $('select[name="kota"]').append('<option value="">-- pilih kota --</option>');
    }
});

$('select[name="kota"]').on('change', function () {

    //clear ongkir
    $('#ongkir-cart').html(0);
    $('#ongkir-cart-hidden').html(0);
    $('#ongkir-service-hidden').html(0);

    //hide ongkir
    $('#ongkir').addClass('d-none');

    //set grand total ke default
    let grandTotal = "{{ $totalPrice }}";
    let diskon = parseInt($('#diskon-hidden').text()) || 0;

    $('#grand-total').html(money_id(parseInt(grandTotal) - parseInt(diskon)));
    $('#grand-total-hidden').html(parseInt(grandTotal) - parseInt(diskon));

    let cityId = $(this).val();
    if (cityId) {
        jQuery.ajax({
            url: '/districts',
            type: "GET",
            dataType: "json",
            data: {
                city: cityId
            },
            success: function (response) {
                $('select[name="kecamatan"]').empty();
                $('select[name="kecamatan"]').append(
                    '<option value="">-- pilih kecamatan --</option>');
                $.each(response.data.results, function (key, value) {
                    $('select[name="kecamatan"]').append('<option value="' +
                        value.id + '">' + value.name + '</option>');
                });
            },
        });
    } else {
        $('select[name="kecamatan"]').append('<option value="">-- pilih kecamatan --</option>');
    }

});

$('select[name="kecamatan"]').on('change', function () {

    //clear ongkir
    $('#ongkir-cart').html(0);
    $('#ongkir-cart-hidden').html(0);
    $('#ongkir-service-hidden').html(0);

    //hide ongkir
    $('#ongkir').addClass('d-none');

    //set grand total ke default
    let grandTotal = "{{ $totalPrice }}";
    let diskon = parseInt($('#diskon-hidden').text()) || 0;

    $('#grand-total').html(money_id(parseInt(grandTotal) - parseInt(diskon)));
    $('#grand-total-hidden').html(parseInt(grandTotal) - parseInt(diskon));

    $('#courier').empty();
    $('#courier').removeClass('d-none');
    $('#courier').append('<div class="form-check form-check-inline">\n' +
        '  <input class="form-check-input select-courier" type="radio" name="courier" id="ongkos_kirim-jne" value="jne">\n' +
        '  <label class="form-check-label font-weight-bold mr-2" for="ongkos_kirim-jne">Jalur Nugraha Ekakurir (JNE)</label>\n' +
        '  <input class="form-check-input select-courier" type="radio" name="courier" id="ongkos_kirim-jnt" value="jnt">\n' +
        '  <label class="form-check-label font-weight-bold" for="ongkos_kirim-jnt">J&T Express (J&T)</label>\n' +
        '</div>')

});

//ongkir change
$(document).delegate(".select-courier", "change", function () {

    //clear ongkir
    $('#ongkir-cart').html(0);
    $('#ongkir-cart-hidden').html(0);
    $('#ongkir-service-hidden').html(0);

    //hide ongkir
    $('#ongkir').addClass('d-none');

    //set grand total ke default
    let grandTotal = "{{ $totalPrice }}";
    let diskon = parseInt($('#diskon-hidden').text()) || 0;

    $('#grand-total').html(money_id(parseInt(grandTotal) - parseInt(diskon)));
    $('#grand-total-hidden').html(parseInt(grandTotal) - parseInt(diskon));

    //cek ongkir
    let token = $("meta[name='csrf-token']").attr("content");
    let courier = $('.select-courier:checked').val();
    let destination = $('select[name=kecamatan]').val();
    let weight = "{{ $weight }}";

    if (courier) {
        jQuery.ajax({
            url: '/shipping',
            type: "POST",
            dataType: "json",
            data: {
                _token: token,
                courier: courier,
                destination: destination,
                weight: weight
            },
            success: function (response) {

                $('#ongkir').empty();
                console.log(response);
                $.each(response.data.results, function (key, value) {
                    $('#ongkir').removeClass('d-none');
                    $('#ongkir').append(
                        '<div class="form-check form-check-inline">\n' +
                        '  <input class="form-check-input ongkos_kirim" type="radio" name="ongkos_kirim" id="ongkos_kirim-' +
                        value.service + '" value="' + courier
                        .toUpperCase() + ' | ' + value.service + ' | ' +
                        value.cost + ' | ' + value.estimate + '">\n' +
                        '  <span class="form-check-label" for="ongkos_kirim-' +
                        value.service + '"> ' + courier.toUpperCase() +
                        ' : <strong>' + value.service +
                        '</strong> - Rp. ' + money_id(value.cost) +
                        ' (' + value.estimate + ' hari)</span>\n' +
                        '</div>')
                });
            },
        });
    } else {

    }

});

});

$(document).ready(function () {

//ongkir change
$(document).delegate(".ongkos_kirim", "change", function () {

    let rajaongkir = $(".ongkos_kirim:checked").val().split("|");

    $('#ongkir-cart').html(money_id(rajaongkir[2]));
    $('#ongkir-cart-hidden').html(rajaongkir[2]);
    $('#ongkir-service-hidden').html(rajaongkir[1]);

    //grand total
    let jumlah = "{{ $totalPrice }}";
    let ongkir = rajaongkir[2];
    let diskon = parseInt($('#diskon-hidden').text()) || 0;
    let grandTotal = parseInt(jumlah) + parseInt(ongkir) - parseInt(diskon);

    $('#grand-total').html(money_id(grandTotal));
    $('#grand-total-hidden').html(grandTotal);

});

});


//cek voucher promo
$(document).ready(function () {

$(document).delegate(".btn-voucher", "click", function () {
    let rules = $(this).data('rules');

    if (rules == 'add') {

        let token = $("meta[name='csrf-token']").attr("content");
        let voucher = $('#voucher').val();
        let grand_total = $('#grand-total-hidden').text();

        //add disable and loding button
        $('.btn-voucher').attr('disabled', 'disabled');
        $('.btn-voucher').html(
            '<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>\n' +
            '  Loading...');

        if (voucher.length == "") {

            toastr.error('Masukkan Kode Voucher !');

            //auto focus set
            $('#voucher').focus();

            //add disable and loding button
            $('.btn-voucher').removeAttr('disabled', 'disabled');
            $('.btn-voucher').html('VALIDASI');

        } else {

            $.ajax({
                url: "/check_voucher",
                data: {
                    _token: token,
                    voucher: voucher
                },
                type: "GET",
                dataType: "json",
                success: function (response) {
                    if (response.success) {

                        if (parseInt(grand_total) < response.data
                            .total_minimal_shopping) {

                            toastr.error('Total Belanja Minimal' + money_id(response
                                .data.total_minimal_shopping));

                            //auto focus set
                            $('#voucher').focus();

                            let btn_voucher = $(".btn-voucher");
                            btn_voucher.text('VALIDASI');
                            btn_voucher.removeAttr('disabled', 'disabled');

                        } else if (parseInt(grand_total) == response.data
                            .total_minimal_shopping || parseInt(grand_total) >
                            response.data.total_minimal_shopping) {

                            toastr.success('Kode Voucher ' + response.data
                                .voucher + ' Berhasil Ditambahkan !');

                            //add diskon to html
                            $('#diskon').html(money_id(response.data
                                .nominal_voucher));
                            $('#diskon-hidden').html(response.data.nominal_voucher);

                            //manipulate grand total
                            $('#grand-total').html(money_id(parseInt(grand_total) -
                                parseInt(response.data.nominal_voucher)));
                            $('#grand-total-hidden').html(parseInt(grand_total) -
                                parseInt(response.data.nominal_voucher));


                            let btn_voucher = $(".btn-voucher");
                            btn_voucher.text('HAPUS');
                            btn_voucher.removeAttr('disabled', 'disabled')
                                .removeClass("btn-primary").addClass("btn-danger")
                                .data('rules', 'delete');

                        } else {

                            toastr.error('Internal Server Error !');

                            let btn_voucher = $(".btn-voucher");
                            btn_voucher.text('VALIDASI');
                            btn_voucher.removeAttr('disabled', 'disabled');

                        }

                    } else {

                        toastr.error('Kode Voucher Tidak Valid !');

                        let btn_voucher = $(".btn-voucher");
                        btn_voucher.text('VALIDASI');
                        btn_voucher.removeAttr('disabled', 'disabled');

                    }
                }
            });

        }

    } else if (rules == 'delete') {

        //grand total
        let diskon = $('#diskon-hidden').text();
        let grand_total = parseInt($('#grand-total-hidden').text()) + parseInt(diskon);

        $('#grand-total').text(money_id(grand_total));
        $('#grand-total-hidden').text(grand_total);

        //make button normal validasi
        let btn_voucher = $(".btn-voucher");
        btn_voucher.text('VALIDASI');
        btn_voucher.removeAttr('disabled', 'disabled').removeClass("btn-danger").addClass(
            "btn-primary").data('rules', 'add');

        // remove voucher and make auto focus
        $('#voucher').val('');
        $('#voucher').focus();

        //remove diskon
        $('#diskon').text('0');
        $('#diskon-hidden').text('0');

    }

});
});

//checkout
$(document).ready(function () {

let isProcessing = false;

$('.btn-checkout').click(function (e) {
    e.preventDefault();

    //add disable and loding button
    $('.btn-checkout').attr('disabled', 'disabled');
    $('.btn-checkout').html(
        '<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>\n' +
        '  Loading...');

    let token = $("meta[name='csrf-token']").attr("content");
    //credential
    let name = $('#nama_lengkap').val();
    let phone = $('#phone').val();
    let province = $('select[name=provinsi]').val();
    let city = $('select[name=kota]').val();
    let district = $('select[name=kecamatan]').val();
    let address = $('textarea#alamat').val();
    let note = $('textarea#catatan').val();
    //ongkir
    let courier = $('.select-courier:checked').val();
    let service = $('#ongkir-service-hidden').text();
    let weight = "{{ $weight }}";
    let cost = $('#ongkir-cart-hidden').text();
    //grand total
    let grand_total = $('#grand-total-hidden').text();

    if (name.length == "") {

        toastr.error('Silahkan Masukkan Nama Lengkap !');

        $('#nama_lengkap').focus();
        //add disable and loding button
        $('.btn-checkout').removeAttr('disabled', 'disabled');
        $('.btn-checkout').html('CHECKOUT');

    } else if (phone.length == "") {

        toastr.error('Silahkan Masukkan No. Telp / WA !');

        $('#phone').focus();
        //add disable and loding button
        $('.btn-checkout').removeAttr('disabled', 'disabled');
        $('.btn-checkout').html('CHECKOUT');

    } else if (province.length == "") {

        toastr.error('Silahkan Pilih Provinsi !');

        $('select[name=provinsi]').focus();
        //add disable and loding button
        $('.btn-checkout').removeAttr('disabled', 'disabled');
        $('.btn-checkout').html('CHECKOUT');

    } else if (city.length == "") {

        toastr.error('Silahkan Pilih Kota / Kabupaten !');

        $('select[name=kota]').focus();
        //add disable and loding button
        $('.btn-checkout').removeAttr('disabled', 'disabled');
        $('.btn-checkout').html('CHECKOUT');

    } else if (district.length == "") {

        toastr.error('Silahkan Pilih Kecamatan !');

        $('select[name=kecamatan]').focus();
        //add disable and loding button
        $('.btn-checkout').removeAttr('disabled', 'disabled');
        $('.btn-checkout').html('CHECKOUT');

    } else if (address.length == "") {

        toastr.error('Silahkan Masukkan Alamat Lengkap !');

        $('textarea#alamat').focus();
        //add disable and loding button
        $('.btn-checkout').removeAttr('disabled', 'disabled');
        $('.btn-checkout').html('CHECKOUT');

    } else if (courier.length == "") {

        toastr.error('Silahkan Pilih Kurir Pengiriman !');

        //add disable and loding button
        $('.btn-checkout').removeAttr('disabled', 'disabled');
        $('.btn-checkout').html('CHECKOUT');

    } else if (service == 0) {

        toastr.error('Silahkan Pilih Layanan Kurir !');

        //add disable and loding button
        $('.btn-checkout').removeAttr('disabled', 'disabled');
        $('.btn-checkout').html('CHECKOUT');

    } else if (weight.length == "") {

        toastr.error('Berat Belanja Kosong !');

        //add disable and loding button
        $('.btn-checkout').removeAttr('disabled', 'disabled');
        $('.btn-checkout').html('CHECKOUT');

    } else if (cost == 0) {

        toastr.error('Biaya Pengiriman Kosong !');

        //add disable and loding button
        $('.btn-checkout').removeAttr('disabled', 'disabled');
        $('.btn-checkout').html('CHECKOUT');

    } else if (grand_total.length == "") {

        toastr.error('Grand Total Kosong !');

        //add disable and loding button
        $('.btn-checkout').removeAttr('disabled', 'disabled');
        $('.btn-checkout').html('CHECKOUT');

    } else {

        if (isProcessing) {
            return;
        }

        isProcessing = true;
        $.ajax({
            url: "/checkout",
            data: {
                _token: token,
                name: name,
                phone: phone,
                province: province,
                city: city,
                district: district,
                address: address,
                note: note,
                courier: courier,
                service: service,
                weight: weight,
                cost: cost,
                grand_total: grand_total
            },
            dataType: "JSON",
            type: "POST",
            success: function (response) {
                isProcessing = false;
                if (response.success) {


                    //add disable and loding button
                    $('.btn-checkout').removeAttr('disabled', 'disabled');
                    $('.btn-checkout').html('CHECKOUT');


                    Turbolinks.visit('payment/'+response.data.invoice)
                }
            },
            error: function (response) {
                console.log(response);
            }

        });

    }

});
});
</script>
