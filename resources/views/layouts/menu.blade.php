<!-- ASSESSMENT MENU -->
<li class="nav-main-heading"><span class="sidebar-mini-visible">A</span><span class="sidebar-mini-hidden">Assessment</span></li>
<li class="{{ Request::is('assessmentSessions*') ? 'active' : '' }}">
    <a href="{!! route('assessmentSessions.index') !!}"><i class="fa fa-edit"></i><span>Assessment Sessions</span></a>
</li>