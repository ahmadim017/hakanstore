<div>

    <div style="margin-top: 100px">
        <div class="container mb-lg-5">

            <div class="row mt-4 mb-4 justify-content-center">

                <div class="col-md-4 text-center">
                    <h3 class="font-weight-bold">TERIMA KASIH</h3>
                    <h5>PESANAN BERHASIL DIBUAT</h5>
                    <hr>
                    {{ $invoice->name }}
                    
                    {{ $invoice->address }}
                </div>

            </div>

            <div class="row">
                <div class="col-md-6 text-center mb-3">
                    <div class="card border-0 rounded-lg shadow">
                        <div class="card-body">
                            <h4 class="font-weight-bold">{{ $invoice->invoice }}</h4>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 text-center mb-3">
                    <div class="card border-0 rounded-lg shadow">
                        <div class="card-body">
                            <h4 class="font-weight-bold">TOTAL : {{ money_id($invoice->grand_total) }}</h4>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="alert alert-danger" role="alert">
                        Silahkan lakukan pembayaran ke salah satu rekening dibawah ini, pastikan nominal transfer sesuai
                        dengan <strong>TOTAL</strong>.
                    </div>
                </div>

                <div class="col-md-4 mt-3 text-center">
                    <div class="card h-100 border-0 rounded-lg shadow">
                        <div class="card-body">
                            <img src="{{ asset('images/payment-bri.png') }}" style="width: 150px">
                            <hr>
                            <h6>AHMAD MUHRANI</h6>
                            <p></p>
                            <h6 class="font-weight-bold">458201027312531</h6>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mt-3 text-center">
                    <div class="card h-100 border-0 rounded-lg shadow">
                        <div class="card-body">
                            <img src="{{ asset('images/payment-mandiri-syariah.png') }}" style="width: 150px">
                            <hr>
                            <h6>AHMAD MUHRANI</h6>
                            <p></p>
                            <h6 class="font-weight-bold">7130309725</h6>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mt-3 text-center">
                    <div class="card h-100 border-0 rounded-lg shadow">
                        <div class="card-body">
                            <img src="{{ asset('images/payment-jenius.png') }}" style="width: 150px">
                            <hr>
                            <h6>AHMAD MUHRANI</h6>
                            <p></p>
                            <h6 class="font-weight-bold">90011961874</h6>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row text-center justify-content-center mt-lg-5 mt-5">
                <div class="col-md-5">
                    Setelah melakukan transfer, silahkan lakukan <strong>konfirmasi pembayaran</strong> melalui tombol
                    dibawah ini :
                    <div class="konfirmasi-pembayaran mt-lg-5">
                        @if (Auth::guard('customer')->check())
                        @if ($invoice->status == "pending")
                        <button data-toggle="modal" data-target="#konfirmasi-pembayaran"
                            class="btn btn-dark btn-lg btn-block mt-3 shadow"> KONFIRMASI PEMBAYARAAN</button>
                        @endif
                        @else
                        <div data-toggle="tooltip" data-placement="bottom" title="Silahkan Masuk Terlebih Dahulu!">
                            <a href="{{ route('customer.auth.login') }}"
                                class="btn btn-dark btn-lg btn-block mt-3 shadow"> KONFIRMASI PEMBAYARAAN</a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="konfirmasi-pembayaran" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">KONFIRMASI PEMBAYARAN </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="confirmPayment" enctype="multipart/form-data">
                        @csrf
                        <div class="row d-none">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold">NAMA LENGKAP</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" readonly
                                        name="name" wire:model="name" placeholder="Nama Lengkap">
                                    @error('name')
                                    <div class="invalid-feedback" style="display: block">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold">NO. TELP / WA</label>
                                    <input type="text" class="form-control" readonly name="phone"
                                        wire:model="phone" placeholder="Nama Lengkap" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">INVOICE</label>
                            <input type="text" class="form-control" name="invoice" readonly
                                wire:model="invoice_id" placeholder="Invoice" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group" wire:ignore>
                                    <label class="font-weight-bold">TRANSFER DARI BANK</label>
                                    <select class="form-control select-bank-from" wire:model="bank_transfer_from" name="bank_transfer_from" required>
                                        <option value="">-- pilih BANK --</option>
                                        <option value="BCA"> BCA </option>
                                        <option value="Bank Mandiri"> Bank Mandiri </option>
                                        <option value="BNI"> BNI </option>
                                        <option value="BRI"> BRI </option>
                                        <option value="CIMB"> CIMB </option>
                                        <option value="BII"> BII </option>
                                        <option value="BJB"> BJB </option>
                                        <option value="BPR"> BPR </option>
                                        <option value="Bukopin"> Bukopin </option>
                                        <option value="Bank Mega"> Bank Mega </option>
                                        <option value="OCBC NISP"> OCBC NISP </option>
                                        <option value="Sinar Mas"> Sinar Mas </option>
                                        <option value="Bank Muamalat"> Bank Muamalat </option>
                                        <option value="Bank Bumi Arta"> Bank Bumi Arta </option>
                                        <option value="Bank Danamon"> Bank Danamon </option>
                                        <option value="Bank Mandiri Syariah"> Bank Mandiri Syariah </option>
                                        <option value="Lainnya"> Lainnya </option>
                                    </select>
                                    @error('bank_transfer_from')
                                    <div class="invalid-feedback" style="display: block">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group" wire:ignore>
                                    <label class="font-weight-bold">TRANSFER KE BANK</label>
                                    <select class="form-control select-bank-to" wire:model="bank_transfer_to" name="bank_transfer_to" required>
                                        <option value="">-- pilih BANK --</option>
                                        <option value="BRI - 458201027312531 - AN. AHMAD MUHRANI"> BRI - 458201027312531 |
                                            AN. AHMAD MUHRANI</option>
                                        <option value="MANDIRI SYARI'AH - 7130309725 - AN. AHMAD MUHRANI">
                                            MANDIRI SYARI'AH - 7130309725 | AN. AHMAD MUHRANI</option>
                                        <option value="JENIUS / BTPN - 90011961874 - AN. FIKA RIDAUL MAULAYYA"> JENIUS /
                                            BTPN - 90011961874 | AN. AHMAD MUHRANI</option>
                                    </select>
                                    @error('bank_transfer_to')
                                    <div class="invalid-feedback" style="display: block">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold">ATAS NAMA</label>
                                    <input type="text" class="form-control" wire:model="from_name" name="from_name" placeholder="Atas Nama"
                                        required>
                                    @error('from_name')
                                    <div class="invalid-feedback" style="display: block">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold">NOMINAL TRANSFER</label>
                                    <input type="number" class="form-control" wire:model="total" name="total"
                                        placeholder="Nominal Transfer" required>
                                    @error('total')
                                    <div class="invalid-feedback" style="display: block">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold">TANGGAL TRANSFER</label>
                                    <input type="date" class="form-control" wire:model="transfer_date" name="transfer_date" required>
                                    @error('transfer_date')
                                    <div class="invalid-feedback" style="display: block">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold">BUKTI TRANSFER (<span style="color: red">ukuran file
                                            maksimal 2 MB</span>) </label>
                                    <input type="file" class="form-control" id="image" wire:model="image" name="image" required>
                                    @error('image')
                                    <div class="invalid-feedback" style="display: block">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                    <span style="color: red">Format File Didukung : <strong>.PNG</strong>,
                                        <strong>.JPG</strong>, <strong>.JPEG</strong></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">CATATAN</label>
                            <textarea class="form-control" name="note" rows="2" wire:model="note" placeholder="Catatan">{{ $note }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-dark btn-block shadow">KIRIM BUKTI PEMBAYARAN</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    $(document).ready(function () {
        $(".select-bank-from , .select-bank-to").select2({
            theme: 'bootstrap4',
            width: 'style',
        });
        $('.select-bank-from').on('change', function (e) {
            @this.set('bank_transfer_from', e.target.value);
        });
        $('.select-bank-to').on('change', function (e) {
            @this.set('bank_transfer_to', e.target.value);
        });
    });
</script>