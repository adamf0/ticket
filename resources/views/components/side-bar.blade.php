<div class="container">
    <!-- <h4 class="text-center pt-4 pb-3">HelpDesk IT</h4> -->
    <div class="pt-4">
    <img style="height:32px;" class="d-flex mx-auto" src="<?php echo asset('assets/logohd.png'); ?>" alt="">
    </div>
    <hr />
    <a href="{{ route('dashboard.index') }}"><i class="material-icons">dashboard</i>&nbsp;&nbsp;Dashboard</a>
    <a class="dropdown-btn" href="#"><i class="material-icons">confirmation_number</i>&nbsp;&nbsp;Tiket</a>
    <ul class="dropdown-container">
        <a href="{{ route('my-ticket.index') }}"><i class="material-icons">format_list_bulleted</i>&nbsp;&nbsp;MyTiket</a>
        <a href="{{ route('my-ticket.index') }}"><i class="material-icons">checklist_rtl</i>&nbsp;&nbsp;MyTask</a>
    </ul>
    <a href="{{ route('form-ticket.index',['type'=>'troubleshooting']) }}"><i class="material-icons">troubleshoot</i>&nbsp;&nbsp;Troubleshoot</a>
    <a href="{{ route('form-ticket.index',['type'=>'permintaan_barang']) }}"><i class="material-icons">add_shopping_cart</i>&nbsp;&nbsp;Permintaan Barang</a>
    <a href="{{ route('form-ticket.index',['type'=>'maintenance']) }}"><i class="material-icons">engineering</i>&nbsp;&nbsp;Maintenance</a>
    <a href="{{ route('form-ticket.index',['type'=>'request_personil']) }}"><i class="material-icons">group_add</i>&nbsp;&nbsp;Request Personel</a>
    <a href="{{ route('logout') }}"><i class="material-icons">logout</i>&nbsp;&nbsp;Logout</a>
</div>

<script>
var dropdown = document.getElementsByClassName("dropdown-btn");
var i;

for (i = 0; i < dropdown.length; i++) {
  dropdown[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var dropdownContent = this.nextElementSibling;
    if (dropdownContent.style.display === "block") {
      dropdownContent.style.display = "none";
    } else {
      dropdownContent.style.display = "block";
    }
  });
}
</script>