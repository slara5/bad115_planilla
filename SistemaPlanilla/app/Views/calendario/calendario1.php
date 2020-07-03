
<style>

  #calendar {
    max-width: 1100px;
    margin: 0 auto;
  }

</style>



  <div id='calendar' class="mb-5"></div>


  <script>
      let my_events = [
            {
            id : 1,
            title: 'All Day Event',
            start: '2020-06-01',
            end: '2020-06-01',
            },
            {
                id : 2,
            title: 'Long Event',
            start: '2020-06-07',
            end: '2020-06-10'
            },
            {
            groupId: 999,
            title: 'Repeating Event',
            start: '2020-06-09T16:00:00'
            },
            {
            groupId: 999,
            title: 'Repeating Event',
            start: '2020-06-16T16:00:00'
            },
            {
            title: 'Conference',
            start: '2020-06-11',
            end: '2020-06-13'
            },
            {
            title: 'Meeting',
            start: '2020-06-12T10:30:00',
            end: '2020-06-12T12:30:00'
            },
            {
            title: 'Lunch',
            start: '2020-06-12T12:00:00'
            },
            {
            title: 'Meeting',
            start: '2020-06-12T14:30:00'
            },
            {
            title: 'Happy Hour',
            start: '2020-06-12T17:30:00'
            },
            {
            title: 'Dinner',
            start: '2020-06-12T20:00:00'
            },
            {
            title: 'Birthday Party',
            start: '2020-06-13T07:00:00'
            },
            {
            title: 'Click for Google',
            url: 'http://google.com/',
            start: '2020-06-28'
            }
      ];

      function eliminar(arg){
        Swal.fire(
            'Good job!',
            'You clicked the button!',
            'success'
            )
        if (confirm('Esta seguro que desea eliminar este evento?')) {
            console.log(arg.event._def.publicId);
          arg.event.remove()
        }
      }

      function get_fecha(fecha){
        let year = fecha.getFullYear();
        let mes = fecha.getMonth() +1;
        let dia = fecha.getDate();
        return year + '-' +mes + '-'+dia;
      }

      function crear(arg){
        Swal.fire({
            title: 'Titulo del evento',
            input: 'text',
            inputAttributes: {
                autocapitalize: 'off'
            },
            showCancelButton: true,
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Crear',
            showLoaderOnConfirm: true,
            preConfirm: (titulo) => {
                $.post("<?= $url_guardar?>",
                {
                    'FECHA_INICIO': get_fecha(arg.start),
                    'FECHA_FIN':  get_fecha(arg.end),
                    'TITULO': titulo,
                },
                function(data, status){
                    console.log(data);
                    if(status == 'success'){
                        calendar.addEvent({
                            id : data,
                            title: titulo,
                            start: arg.start,
                            end: arg.end,
                            allDay: arg.allDay
                        })

                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Exito',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }
                    
                });
            },
            allowOutsideClick: () => !Swal.isLoading()
        });


        /* var title = prompt('Titulo:');
        if (title) {
          calendar.addEvent({
            title: title,
            start: arg.start,
            end: arg.end,
            allDay: arg.allDay
          })
        }*/
        calendar.unselect()
      } 

      
  </script>