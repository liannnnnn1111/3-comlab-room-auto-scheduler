<!DOCTYPE html>

<html lang="en">
	<!--begin::Head-->
	<head>
		<base href="../">
		<title>Scheduling</title>
		<script type="text/javascript" src="jquery.js"></script>
		<link rel="canonical" href="https://preview.keenthemes.com/metronic8" />
		<link rel="shortcut icon" href="logo.png" />
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
		<link href="assets/plugins/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css" />
		<link href="assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
		<link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
		<link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
	</head>

	<body id="kt_app_body" data-kt-app-layout="dark-sidebar" data-kt-app-header-fixed="true" data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-hoverable="true" data-kt-app-sidebar-push-header="true" data-kt-app-sidebar-push-toolbar="true" data-kt-app-sidebar-push-footer="true" data-kt-app-toolbar-enabled="true" class="app-default">
		<!--begin::Theme mode setup on page load-->
		<script>var defaultThemeMode = "light"; var themeMode; if ( document.documentElement ) { if ( document.documentElement.hasAttribute("data-bs-theme-mode")) { themeMode = document.documentElement.getAttribute("data-bs-theme-mode"); } else { if ( localStorage.getItem("data-bs-theme") !== null ) { themeMode = localStorage.getItem("data-bs-theme"); } else { themeMode = defaultThemeMode; } } if (themeMode === "system") { themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light"; } document.documentElement.setAttribute("data-bs-theme", themeMode); }</script>
		<!--end::Theme mode setup on page load-->
		<!--begin::App-->
		<div class="d-flex flex-column flex-root app-root" id="kt_app_root">
			<!--begin::Page-->
			<div class="app-page flex-column flex-column-fluid" id="kt_app_page">
				<!--begin::Header-->
				<div id="kt_app_header" class="app-header" data-kt-sticky="true" data-kt-sticky-activate="{default: true, lg: true}" data-kt-sticky-name="app-header-minimize" data-kt-sticky-offset="{default: '200px', lg: '0'}" data-kt-sticky-animation="false">
					<!--begin::Header container. NAVIGATIONNNNNN-->
					<?php include "part/nav.php" ?>
					<!--end::Header container-->
				</div>
				<!--end::Header-->
				<!--begin::Wrapper-->
				<div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
					<!--begin::Sidebar-->
					<?php include 'part/sidebar.php'; ?>
					<!--end::Sidebar-->
					<!--begin::Main-->
					<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
						<!--begin::Content wrapper-->
						<!-- CONTENT CONTENT CONTENTTTTTTTTTTTT -->
						<div class="d-flex flex-column flex-column-fluid" style="background-color: #whitesmoke; height: 1vh;">
							<div id="kt_app_content" class="app-content flex-column-fluid">
								<div id="kt_app_content_container" class="app-container container-fluid" >
									<div class="data row g-5 gx-xl-10 mb-5 mb-xl-10" style="padding-top: 2%;">
										<div>
											<!-- ENROLLMENT CONTENTTTTTTTTT -->
											<input style="width: 23%;" type="" name="" id="subject" placeholder="subject">
											<input style="width: 4%; " type="" name="" id="grade" placeholder="grade">
											<input style="width: 26%;" type="" name="" id="course" placeholder="course">
											<input style="width: 5%;" type="" name="" id="section" placeholder="section">
											<input style="width: 20%;" type="" name="" id="adviser" placeholder="adviser">
											<button style="width: 5.3%; background-color: #E6e8e6;" onclick="create()">create</button>
										</div>

										<style>
											tr:nth-child(even) {
								            background-color: #Edf2eb;
								        	}
								        	tr:nth-child(odd) {
								            background-color: #F6faf6;
								    		}


								    		table {
						                        border-collapse: collapse;
						                        width: 100%;
						                    }
						                    th, td {
						                        border: 1px solid lightslategrey; 
						                        text-align: center;
						                    }
										</style>
										<div class="mh-500px scroll-y me-n5 pe-7">
											<table style="text-align: center; width: 100%;">
												<thead style="position: sticky; top: 0;">
													<tr style="background-color: green; color: white;">
														<th width="21%">Subject</th>
														<th width="4%">Grade</th>
														<th width="26%">Course</th>
														<th width="4%">Section</th>
														<th width="15%">Adviser</th>
														<th width="4%">Room</th>
														<th width="9%">Day</th>
														<th width="12%">Time</th>
														<th width="5%">Action</th>
													</tr>
												</thead>
												<tbody id='tdata'>

												</tbody>
											</table>
										</div>	
									</div>
								</div>
							</div>
						</div>
						<!--end::Content wrapper-->
						<!--begin::Footer-->
						<!-- FOOTER FOOTER FOOTERRRRRRRRRRRRRRRRRRRR-->
						<?php include "part/footer.php" ?>
						<!--end::Footer-->
					</div>
					<!--end:::Main-->
				</div>
				<!--end::Wrapper-->
			</div>
			<!--end::Page-->
		</div>
		<!--end::App-->
		<!--begin::Drawers-->

		<!--begin::Activities drawer-->
		<div id="kt_activities" class="bg-body" data-kt-drawer="true" data-kt-drawer-name="activities" data-kt-drawer-activate="true" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'300px', 'lg': '900px'}" data-kt-drawer-direction="end" data-kt-drawer-toggle="#kt_activities_toggle" data-kt-drawer-close="#kt_activities_close">

		</div>
		<!--end::Activities drawer-->
		
		<!--begin::Scrolltop-->
		<div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
			<i class="ki-duotone ki-arrow-up">
				<span class="path1"></span>
				<span class="path2"></span>
			</i>
		</div>
		<!--end::Scrolltop-->
		
		
		<!--begin::Javascript-->
		<script>var hostUrl = "assets/";</script>
		<!--begin::Global Javascript Bundle(mandatory for all pages)-->
		<script src="assets/plugins/global/plugins.bundle.js"></script>
		<script src="assets/js/scripts.bundle.js"></script>
		<!--end::Global Javascript Bundle-->
		<!--begin::Vendors Javascript(used for this page only)-->
		<script src="assets/plugins/custom/fullcalendar/fullcalendar.bundle.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/index.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/radar.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/map.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/geodata/worldLow.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/geodata/continentsLow.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/geodata/usaLow.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZonesLow.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZoneAreasLow.js"></script>
		<script src="assets/plugins/custom/datatables/datatables.bundle.js"></script>
		<!--end::Vendors Javascript-->
		<!--begin::Custom Javascript(used for this page only)-->
		<script src="assets/js/widgets.bundle.js"></script>
		<script src="assets/js/custom/widgets.js"></script>
		<script src="assets/js/custom/apps/chat/chat.js"></script>
		<script src="assets/js/custom/utilities/modals/upgrade-plan.js"></script>
		<script src="assets/js/custom/utilities/modals/create-app.js"></script>
		<script src="assets/js/custom/utilities/modals/new-target.js"></script>
		<script src="assets/js/custom/utilities/modals/users-search.js"></script>
		<!--end::Custom Javascript-->
		<!--end::Javascript-->
	</body>
	<!--end::Body-->
</html>

<script type="text/javascript">
	function retrieve(){ 
		$.ajax({
			type:'POST',
			url: 'admin/controller.php',
			data:{action:'retrieve'},
			dataType:'html',
			success: function(response){ //if success gagana to
				// alert(response);
				document.getElementById('tdata').innerHTML=response;
			}
		})
	}
	retrieve();
	
	function create(){ 
		var u_subject=$('#subject').val(); //yung may # nakuha sa id ng input
		var u_grade=$('#grade').val();
		var u_course=$('#course').val();
		var u_section=$('#section').val();
		var u_adviser=$('#adviser').val();
		$.ajax({
			type:'POST',
			url: 'admin/controller.php',
			data:{insert:'account', subject:u_subject, grade:u_grade, course:u_course, section:u_section, adviser:u_adviser},
			dataType:'html',
			success: function(response){
				alert(response);
				retrieve();
			}
		})

	}
</script>