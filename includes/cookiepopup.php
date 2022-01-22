<?php
$html = '<script>
// Handle switch changes
function checkswitch(elem) {
  var text = elem.parentElement.parentNode.getElementsByClassName("onoroff")[0];
  if (elem.parentNode.getElementsByTagName("input")[0].checked) {
    text.textContent = "#notactive#";
    text.classList.remove("on");
    text.classList.add("off");
  } else {
    text.textContent = "#active#";
    text.classList.remove("off");
    text.classList.add("on");
  }
}
</script>
<div id="dcpbanner" class="pos-#position#">
	<div class="dcp-content"><div class="dcp-btext">#bannertext#</div><div class="dcp-boptions"><a id="dcp-accept" class="dcp-close dcp-allow">#buttonoktext#</a><a id="dcp-set" class="dcp-settings">#linksettings#</a></div></div>
</div>
<div id="dcppopup" class="animated fadeIn" tabindex="-1">
	<div class="dcp-content">
		<div class="dcp-heading">
			<h2>#popuptitle#</h2>
			<div id="close"><i class="icon bsm-remove"></i></div>
			#popupintro#
		</div>
		<div class="dcp-body">
			<div class="func_set">
				<div class="collapsible">
					<i class="icon bsm-chevron"></i>#functional#
					<b class="onoroff off">#alwaysactive#</b>
				</div>
				<div class="content animated fadeIn">#popupfunc#</div>
			</div>
			<div class="ana_set">
				<div class="collapsible">
					<i class="icon bsm-chevron"></i>#analytical#
					<label class="switch" >
						<input type="checkbox" id="analytics">
						<span class="slider round" onclick="checkswitch(this);"></span>
					</label>
					<b class="onoroff off">#analyticsinitial#</b>
				</div>
				<div class="content animated fadeIn">#popupana#</div>
			</div>
			<div class="mark_set">
				<div class="collapsible">
					<i class="icon bsm-chevron"></i>#marketing#
					<label class="switch" >
						<input type="checkbox" id="marketing">
						<span class="slider round" onclick="checkswitch(this);"></span>
					</label>
					<b class="onoroff off">#marketinginitial#</b>
				</div>
				<div class="content animated fadeIn">#popupmark#</div>
			</div>
		</div>
		<div class="dcp-footer">
			<a class="savebtn" id="save">#buttonsave#</a>
			<a class="acceptbtn" id="accept">#buttonall#</a>
		</div>
	</div>
</div>';
?>