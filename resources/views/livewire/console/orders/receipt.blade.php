<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card border-0 shadow rounded-lg">
            <div class="card-header">
                <i class="fa fa-shopping-cart"></i> RECEIPT ORDERS
            </div>
            <div class="card-body">
                <form wire:submit.prevent="update">
                    <div class="form-group" wire:ignore>
                        <label>INPUT RECEIPT ORDER</label>
                        <input type="hidden" wire:model="invoiceId">
                        <input type="text" class="form-control" placeholder="Input Receipt Courier" wire:model="receipt">
                    </div>
                    <button class="btn btn-primary mr-1 btn-submit" type="submit"> UPDATE</button>
                    <button class="btn btn-warning btn-reset" type="reset"> RESET</button>
                </form>
            </div>
        </div>
    </div>
</div>
