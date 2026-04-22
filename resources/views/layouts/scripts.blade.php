   <script
     src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/browser/overlayscrollbars.browser.es6.min.js"
     crossorigin="anonymous"></script>
   <!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
   <script
     src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
     crossorigin="anonymous"></script>
   <!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
   <script
     src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js"
     crossorigin="anonymous"></script>
   <!--end::Required Plugin(Bootstrap 5)--><!--begin::Required Plugin(AdminLTE)-->
   <script src="{{ asset('admin/dist/js/adminlte.js') }}"></script>
   <!--end::Required Plugin(AdminLTE)--><!--begin::OverlayScrollbars Configure-->
   <script>
     const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
     const Default = {
       scrollbarTheme: 'os-theme-light',
       scrollbarAutoHide: 'leave',
       scrollbarClickScroll: true,
     };
     document.addEventListener('DOMContentLoaded', function() {
       const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);

       // Disable OverlayScrollbars on mobile devices to prevent touch interference
       const isMobile = window.innerWidth <= 992;

       if (
         sidebarWrapper &&
         OverlayScrollbarsGlobal?.OverlayScrollbars !== undefined &&
         !isMobile
       ) {
         OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
           scrollbars: {
             theme: Default.scrollbarTheme,
             autoHide: Default.scrollbarAutoHide,
             clickScroll: Default.scrollbarClickScroll,
           },
         });
       }
     });
   </script>
   <!--end::OverlayScrollbars Configure-->

   <!-- OPTIONAL SCRIPTS -->

   <!-- sortablejs -->
   <script
     src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"
     crossorigin="anonymous"></script>

   <!-- sortablejs -->
   <script>
     new Sortable(document.querySelector('.connectedSortable'), {
       group: 'shared',
       handle: '.card-header',
     });

     const cardHeaders = document.querySelectorAll('.connectedSortable .card-header');
     cardHeaders.forEach((cardHeader) => {
       cardHeader.style.cursor = 'move';
     });
   </script>

 

   <!-- jsvectormap -->
   <script
     src="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/js/jsvectormap.min.js"
     integrity="sha256-/t1nN2956BT869E6H4V1dnt0X5pAQHPytli+1nTZm2Y="
     crossorigin="anonymous"></script>
   <script
     src="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/maps/world.js"
     integrity="sha256-XPpPaZlU8S/HWf7FZLAncLg2SAkP8ScUTII89x9D3lY="
     crossorigin="anonymous"></script>

   <!-- jsvectormap -->
 
   <!-- Flatpickr JS -->
   <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
   <script>
    flatpickr("#date_of_death", {
        dateFormat: "Y-m-d",
        maxDate: "today"
    });
     flatpickr("#cremation_date", {
        dateFormat: "Y-m-d",
        maxDate: "today"
    });
    flatpickr("#donation_date", {
        dateFormat: "Y-m-d",
        maxDate: "today"
    });
    flatpickr("#death_time", {
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
        time_12hr: true
    });
</script>