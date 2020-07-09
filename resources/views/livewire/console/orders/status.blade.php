<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card border-0 shadow rounded-lg">
            <div class="card-header">
                <i class="fa fa-shopping-cart"></i> STATUS ORDERS
            </div>
            <div class="card-body">
                <form wire:submit.prevent="update">
                    <div class="form-group" wire:ignore>
                        <label>CHANGE STATUS ORDER</label>
                        <input type="hidden" wire:model="invoiceId">
                        <select class="select2 form-control" wire:model="status" required>
                            <option value="">-- STATUS --</option>
                            <option value="payment_invalid">pembayaran tidak valid</option>
                            <option value="progress">pesanan diproses</option>
                            <option value="shipping">pesanan dikirim</option>
                            <option value="done">pesanan selesai</option>
                        </select>
                    </div>
                    <button class="btn btn-primary mr-1 btn-submit" type="submit"> UPDATE</button>
                    <button class="btn btn-warning btn-reset" type="reset"> RESET</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        //category
        $('.select2').select2({
            theme: 'bootstrap4',
            width: 'style'
        });
        $('.select2').on('change', function (e) {
            @this.set('status', e.target.value);
        });
    });
</script>