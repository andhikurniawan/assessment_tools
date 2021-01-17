<div class ="container">
<a href="/competencyGroups" class="logo">
<b>Competency Group</b>
</a>
<br><br>
<a href="/competencies" class="logo">
<b>Competency</b>
</a>

<br><br>
<a href="/keyBehaviours" class="logo">
<b>Key Behaviour</b>
</a>

<br><br>
<a href="/competencyModels" class="logo">
<b>Competency Model</b>
</a>
</div>
<!-- ASSESSMENT MENU -->
<li class="nav-main-heading"><span class="sidebar-mini-visible">A</span><span class="sidebar-mini-hidden">Assessment</span></li>
<li class="{{ Request::is('assessmentSessions*') ? 'active' : '' }}">
    <a href="{!! route('assessmentSessions.index') !!}"><i class="fa fa-edit"></i><span>Assessment Sessions</span></a>
</li>
