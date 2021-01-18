<nav class="navbar navbar-expand-md navbar-light fixed-top sticky-top nav-menu">

<div class="col-md-2 col-xs-12 p-left  p-right">

 <button  class="btn btn-link btn-sm text-white order-1 order-sm-0"  id="sidebarToggle" >
   <i class="fas fa-bars"></i>
 </button>
   <div class="logo">
       <a href="#">
       <img src="{{asset('FrontEnd/images/header/logo.png')}}" alt="logo" >
       </a>
   </div>
</div>
 <!-- Navbar -->
   <div class="col-md-5 col-xs-12 p-left  p-right">
        <div class="searching">
           <form>
           <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
           <input type="text" name="search" placeholder="Search Places, Events, House, Shop, Bike, Car, Mobile etc...">
           </form>
       </div>
   </div>
       <div class="col-md-5 col-xs-12 p-left p-right">
        <div class="add-listing">
           <a href="upload.html">
           <img src="{{asset('FrontEnd/images/header/plus-ico.png')}}" alt="">
           Add Listing</a>
        </div>
        <div class="home">
           <ul>
               <li>
                   <a  href="index-2.html"><img src="{{asset('FrontEnd/images/header/home.png')}}" alt="" title="" >
                       <span>1</span>
                   </a>
               </li>
               <li class="popup"  onclick="myFunctionmsg()">
                   <img src="{{asset('FrontEnd/images/header/mgs.png')}}" alt="" title="" >
                   <span>4</span>
                   <div class="popuptext" id="message">
                       <div class="notfication-details">
                           <div class="noty-user-img">
                               <img src="{{asset('FrontEnd/images/resources/ny-img1.png')}}" alt="">
                           </div>
                           <div class="notification-info">
                               <h5><a href="message.html">Jassica William</a>
                               Lorem ipsum dolor sit amet, 
                               consectetur adipisicing elit,</h5>
                               <p>2 min ago</p>
                           </div><!--notification-info -->
                       </div>
                       <div class="notfication-details">
                           <div class="noty-user-img">
                               <img src="{{asset('FrontEnd/images/resources/ny-img1.png')}}" alt="">
                           </div>
                           <div class="notification-info">
                               <h5><a href="message.html">Jassica William</a>
                               Lorem ipsum dolor sit amet, consectetur adipisicing elit, 
                               .</h5>
                               <p>2 min ago</p>
                           </div><!--notification-info -->
                       </div>

                       <div class="notfication-details">
                           <div class="noty-user-img">
                               <img src="{{asset('FrontEnd/images/resources/ny-img1.png')}}" alt="">
                           </div>
                           <div class="notification-info">
                               <h5><a href="message.html">Jassica William</a> 
                               Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                               </h5>
                               <p>2 min ago</p>
                           </div><!--notification-info -->
                       </div>
                       
                    </div>
           
               </li>
               <li class="popup"  onclick="myFunctionicon()">
                   <img src="{{asset('FrontEnd/images/header/notification.png')}}" alt="" title="" >
               <span>2</span>
               <div class="popuptext" id="icon">
                       <div class="notfication-details">
                          
                       </div>
                    </div>
               </li>       
           </ul>
        </div>
        <!--#Home-->
        <div class="login popup"  onclick="signin()">
           
           <img src="images/header/u-icon.png" title="" alt="">
           John Deo
           <div class="popuptext1" id="signin">
                       <div class="notfication-details">
                           <div class="notification-info">
                               <a href="my_profile_account.html" >Profile </a>
                           
                           </div>
                       </div>
                       <div class="notfication-details">
                           <div class="notification-info">
                               <a href="my_profile_dashboard.html">Dashboard</a>
                           </div>
                       </div>
                       <div class="notfication-details">
                           <div class="notification-info">
                               <a href="my_profile_view_detail.html">Profile Detail</a>
                           </div>
                       </div>
                       <div class="notfication-details">
                           <div class="notification-info">
                               <a href="signin.html" >Sign In</a>
                           </div><!--notification-info -->
                       </div>
                    </div>
           
       
           
        </div>
       </div>
</nav>