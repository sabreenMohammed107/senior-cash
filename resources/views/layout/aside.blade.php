      <!-- Sidebar Navigation Left -->
      <aside id="ms-side-nav" class="side-nav fixed ms-aside-scrollable ms-aside-left">

<!-- Logo -->
<div class="logo-sn ms-d-block-lg">
  <a class="pl-0 ml-0 text-center" href="{{url('/')}}"> <img src="{{ asset('adminasset/img/63831460-money-wallet-icon-business-investment-concept-flat-vector-illustration.jpg')}}" alt="logo"> </a>
</div>

<!-- Navigation -->
<ul class="accordion ms-main-aside fs-14" id="side-nav-accordion">
  <!-- Home -->
  <li class="menu-item ">
    <a class="active" href="{{url('/')}}">
      <span><i class="material-icons fs-16">home</i>Home </span>
    </a>

  </li>
  <!-- /Home -->
  <!-- Setup  -->
  <li class="menu-item">
    <a href="#" class="has-chevron" data-toggle="collapse" data-target="#create" aria-expanded="false"
       aria-controls="tables">
      <span><i class="material-icons fs-16">build</i>Setup</span>
    </a>
    <ul id="create" class="collapse" aria-labelledby="tables" data-parent="#side-nav-accordion">
      <li> <a href="{{ route('cash-box.index') }}">Cash Box</a> </li>
    
      <!-- <li> <a href="_currencies.html">Currencies</a> </li> -->
    
    </ul>
  </li>
  <!--  Setup  -->
  
<!-- Operations  --> 
<li class="menu-item">
<a href="#" class="has-chevron" data-toggle="collapse" data-target="#operationdropdown" aria-expanded="false"
   aria-controls="contactsdropdown">
  <span><i class="material-icons fs-16">assignment</i>Operations</span>
</a>
<ul id="operationdropdown" class="collapse" aria-labelledby="basic-elements" data-parent="#side-nav-accordion">
<li> <a href="{{ route('cash-finance.index') }}">transaction</a> </li>

<li> <a href="{{ route('cash-operation.index') }}">Operations</a> </li>

</ul>

</li>

</ul>


</aside>