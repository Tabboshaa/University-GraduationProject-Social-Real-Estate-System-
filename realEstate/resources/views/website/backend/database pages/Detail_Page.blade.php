@extends('website.backend.database pages.Item')
@section('Item_Main_Type_table')
<div class="row">
    <div class="col-sm-22">
      &nbsp;&nbsp;&nbsp;&nbsp;
      <label>Go To:</label>
      <select id="got_to_step">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
      </select>

    <!-- SmartWizard html -->
    <div id="smartwizard">

        <ul class="nav">
        @foreach($property as $p1)   
        <li class="nav-item">
              <a class="nav-link" href="#step-{{$p1->Property_Id}}">
                <strong>{{$p1->Property_Name}}</strong> <br>
              </a>
            </li>
            @endforeach
        </ul>
        
        @foreach($property as $p2)   
        <div class="tab-content">
            <div id="step-{{$p2->Property_Id}}" class="tab-pane" role="tabpanel" aria-labelledby="step-1">
            <form method="POST" action="{{ url('/add_Item_Detail/'.$main_type.'/'.$sub_type.'/'.$p2->Property_Id) }}" enctype="multipart/form-data">
            @csrf
            <div class="x_title">
                <h2> {{ __($p2->Property_Name) }}</h2>
                <br>
            </div>

            @foreach($detail as $d)
            <!-- da el area -->
            @if($d->Property_Id === $p2->Property_Id)
            <div class="item form-group">
                <label for="{{$d->Detail_Name}}" class="col-form-label col-md-5 col-sm-3 label-align">{{ __($d->Detail_Name) }}</label>
                <!--  -->
                <div class="col-md-6 col-sm-6">
                    <input type="text" class="form-control @error('DetailName') is-invalid @enderror" name='{{$d->Property_Detail_Id}}' value="{{ old('DetailName') }}" required autocomplete="DetailName" autofocus>

                    @error('DetailName')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            @endif
            @endforeach
            <!-- END OF FOREACH -->
            <input type="submit" />
        </form>
            </div>
        @endforeach
        </div>
    </div>

    <br /> &nbsp;

    <script type="text/javascript">
        $(document).ready(function(){

            // Toolbar extra buttons
            var btnFinish = $('<button></button>').text('Finish')
                                             .addClass('btn btn-info')
                                             .on('click', function(){ alert('Finish Clicked'); });
            var btnCancel = $('<button></button>').text('Cancel')
                                             .addClass('btn btn-danger')
                                             .on('click', function(){ $('#smartwizard').smartWizard("reset"); });

            // Step show event
            $("#smartwizard").on("showStep", function(e, anchorObject, stepNumber, stepDirection, stepPosition) {
                $("#prev-btn").removeClass('disabled');
                $("#next-btn").removeClass('disabled');
                if(stepPosition === 'first') {
                    $("#prev-btn").addClass('disabled');
                } else if(stepPosition === 'last') {
                    $("#next-btn").addClass('disabled');
                } else {
                    $("#prev-btn").removeClass('disabled');
                    $("#next-btn").removeClass('disabled');
                }
            });

            // Smart Wizard
            $('#smartwizard').smartWizard({
                selected: 0,
                theme: 'dots', // default, arrows, dots, progress
                // darkMode: true,
                transition: {
                    animation: 'slide-horizontal', // Effect on navigation, none/fade/slide-horizontal/slide-vertical/slide-swing
                },
                toolbarSettings: {
                    toolbarPosition: 'both', // both bottom
                    toolbarExtraButtons: [btnFinish, btnCancel]
                }
            });

            // External Button Events
            $("#reset-btn").on("click", function() {
                // Reset wizard
                $('#smartwizard').smartWizard("reset");
                return true;
            });

            $("#prev-btn").on("click", function() {
                // Navigate previous
                $('#smartwizard').smartWizard("prev");
                return true;
            });

            $("#next-btn").on("click", function() {
                // Navigate next
                $('#smartwizard').smartWizard("next");
                return true;
            });


            // Demo Button Events
            $("#got_to_step").on("change", function() {
                // Go to step
                var step_index = $(this).val() - 1;
                $('#smartwizard').smartWizard("goToStep", step_index);
                return true;
            });

        });
    </script>  
    </div>
</div>
</div>
@endsection