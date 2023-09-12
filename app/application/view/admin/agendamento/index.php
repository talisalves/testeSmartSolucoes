<?php
$title = ' - Configurações do Sistema';
$css = [
    'assets/admin/css/plugins/fullcalendar/fullcalendar.css',
];
$script = [
    'assets/admin/js/plugins/fullcalendar/moment.min.js',
    'assets/admin/js/plugins/fullcalendar/fullcalendar.min.js',

];
require APP . 'view/admin/_templates/initFile.php';
?>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="text-center m-t-lg">
                <h1>
                    Painel do Sistema -
                    <?= APP_TITLE ?>
                </h1>

            </div>
        </div>
        <div class="col-lg-12 h-full">
            <div class="ibox-content h-full">
                <div id="calendar"></div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        var calendar = $("#calendar").fullCalendar({
            header: {
                left: "prev,next today",
                center: "title",
                right: "month,agendaWeek,agendaDay,listMonth",
            },
            editable: true,
            events: "/ajaxGet?controller=Agendamento&action=getAgendamento&param=",
            displayEventTime: true,
            editable: true,
            eventRender: function (event, element, view) {
                if (event.allDay === "true") {
                    event.allDay = true;
                } else {
                    event.allDay = false;
                }
            },
            selectable: true,
            selectHelper: true,
            eventClick: function (info) {
                document.getElementById("title").value = ''
                document.getElementById("id").value = ''
                $("#btnUpdate").show()
                $("#btnSubmit").hide()
                $.ajax({
                    url: "/ajax",
                    data: {
                        controller: "Agendamento",
                        action: "find",
                        param: info.id,
                    },
                    type: "POST",
                    success: function (data) {
                        const obj = JSON.parse(data);
                        $("#modal-agendamemnto").modal("show");
                        document.getElementById("title").value = obj.title;
                        document.getElementById("id").value = obj.id;

                    },
                });

                $("#btnRemover").on("click", function () {

                    var id = document.getElementById("id").value

                    var data = {
                        id: id,
                    };

                    $.ajax({
                        url: "/ajax",
                        data: {
                            controller: "Agendamento",
                            action: "destroy",
                            param: data,
                        },
                        type: "POST",
                        success: function (data) {
                            window.location.reload();

                        },
                    });
                });

                $("#btnUpdate").on("click", function () {

                    var id = document.getElementById("id").value
                    var title = document.getElementById("title").value;
                    var status = document.getElementById("status");

                    var data = {
                        id: id,
                        title: title
                    };
                    console.log(title);
                    $.ajax({
                        url: "/ajax",
                        data: {
                            controller: "Agendamento",
                            action: "update",
                            param: data,
                        },
                        type: "POST",
                        success: function (data) {
                            window.location.reload();

                        },
                    });
                });



            },


            select: function (start, end, allDay) {

                $("#btnUpdate").hide()
                $("#btnSubmit").show()

                // document.getElementById("title").value = ''
                // document.getElementById("id").value = ''

                var formattedStartDate = moment(start).format("YYYY-MM-DD");
                var formattedEndDate = moment(end).format("YYYY-MM-DD");
                var title1 = document.getElementById("title").value = title.value
                var status = document.getElementById("status");
                var id = document.getElementById("id");

                $("#modal-agendamemnto").modal("show");

                $("#btnSubmit").on("click", function () {
                    var data = {
                        start: formattedStartDate,
                        end: formattedEndDate,
                        title: title1,
                        status: status,
                    };

                    $.ajax({
                        url: "/ajax",
                        data: {
                            controller: "Agendamento",
                            action: "store",
                            param: data,
                        },
                        type: "POST",
                        success: function (data) {
                            setTimeout(() => {
                                window.location.reload();
                            }, 1000);
                        },
                    });

                    calendar.fullCalendar("unselect");
                });
            },
        });

    });

</script>

<?php
require APP . 'view/admin/agendamento/modalAgendamento.php';
require APP . 'view/admin/_templates/endFile.php';
?>