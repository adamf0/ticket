<div class="container">
    <!-- <h4 class="text-center pt-4 pb-3">HelpDesk IT</h4> -->
    <div class="pt-4">
    <img style="height:32px;" class="d-flex mx-auto" src="<?php echo asset('assets/logohd.png'); ?>" alt="">
    </div>
    <hr />
    <a href="{{ route('dashboard.index') }}"><i class="material-icons">dashboard</i>&nbsp;Dashboard</a>
    <a href="{{ route('my-ticket.index') }}"><i class="material-icons">confirmation_number</i>&nbsp;MyTiket</a>
    <a href="{{ route('form-ticket.index',['type'=>'troubleshooting']) }}"><i class="material-icons">troubleshoot</i>&nbsp;Troubleshoot</a>
    <a href="{{ route('form-ticket.index',['type'=>'permintaan_barang']) }}"><i class="material-icons">add_shopping_cart</i>&nbsp;Permintaan Barang</a>
    <a href="{{ route('form-ticket.index',['type'=>'maintenance']) }}"><i class="material-icons">engineering</i>&nbsp;Maintenance</a>
    <a href="{{ route('form-ticket.index',['type'=>'request_personil']) }}"><i class="material-icons">group_add</i>&nbsp;Request Personel</a>
    <a href="{{ route('logout') }}"><i class="material-icons">logout</i>&nbsp;Logout</a>
</div>