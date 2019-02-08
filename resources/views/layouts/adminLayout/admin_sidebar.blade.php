<!--sidebar-menu-->
<div id="sidebar"><a href="{{url('/admin/dashboard')}}" class="visible-phone"><i class="icon icon-home"></i> Dashboard</a>
  <ul>
    <li class="active"><a href="{{url('/admin/dashboard')}}"><i class="icon icon-home"></i> <span>Dashboard</span></a> </li>
	<li><a href="{{url('/admin/profile')}}"><i class="icon-user"></i> <span>My Profile</span></a> </li>
	<li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Members Management</span> <span class="label label-important">3</span></a>
      <ul>
	  <li><a href="{{url('/admin/members/add-member')}}"><i class="icon-user"></i><span>Create Member</span></a></li>
        <li><a href="{{url('/admin/members/index')}}"><i class="icon-user"></i><span>Member Listing</span></a></li>
		 <li><a href="{{url('/admin/reports/customer')}}"><i class="icon-download"></i><span>Export</span></a></li>
        <!--<li><a href="form-validation.html">Form with Validation</a></li>
        <li><a href="form-wizard.html">Form with Wizard</a></li>-->
      </ul>
    </li>
	<li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>CMS</span> <span class="label label-important">2</span></a>
      <ul>
	 <li><a href="{{url('/admin/cmspages')}}"><i class="icon-copy"></i> <span>Cms Pages</span></a> </li>
	 <li><a href="{{url('/admin/faqs')}}"><i class="icon-question-sign"></i> <span>FAQ's</span></a> </li>
      </ul>
    </li>
	<li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Preference</span> <span class="label label-important">4</span></a>
      <ul>
	 <li><a href="{{url('/admin/emailtemplates')}}"><i class="icon-envelope-alt"></i> <span>Email Templates</span></a> </li>
	  <li><a href="{{url('/admin/smstemplates')}}"><i class="icon-envelope-alt"></i> <span>SMS Templates</span></a> </li>
	  <li><a href="{{url('/admin/newsletters')}}"><i class=" icon-envelope"></i> <span>News Letter</span></a> </li>
	  <li><a href="{{url('/admin/banners')}}"><i class=" icon-picture"></i> <span>Banners Image</span></a> </li>
      </ul>
    </li>
	<li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Settings</span> <span class="label label-important">1</span></a>
      <ul>
	 <li><a href="{{url('/admin/generalsetting')}}"><i class="icon icon-cog"></i> <span>Site Settings</span></a> </li>
      </ul>
    </li>
	
	<li><a href="{{url('/logout')}}"><i class="icon-off"></i> <span>Log Out</span></a> </li>
    
        
  </ul>
</div>
<!--sidebar-menu-->