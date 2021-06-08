<div class="modal fade" id="BeOwnerModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Need more information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="BeOwnerForm" method="Post" action="{{url('BeOwner/'.Auth::id())}}">
                    @csrf
                    <input type="hidden" name="id" id="id">

                    <div class="form-group">
                        <label style="font-size: 12pt">First Name</label>
                        <input type="text" style="border-radius: 3pt" name="First" class="form-control">

                    </div>

                    <div class="form-group">
                        <label style="font-size: 12pt">Middle Name</label>
                        <input type="text" style="border-radius: 3pt" name="Middle" class="form-control">

                    </div>
                    <div class="form-group">
                        <label style="font-size: 12pt">Last Name</label>
                        <input type="text" style="border-radius: 3pt" name="Last" class="form-control">

                    </div>
                    <div class="form-group">
                        <label style="font-size: 12pt">Phone Number</label>
                        <input type="text" style="border-radius: 3pt" name="Phone" class="form-control">

                    </div>
                    <div class="form-group">
                        <label style="font-size: 12pt">National ID</label>
                        <input type="text" style="border-radius: 3pt" name="National" class="form-control">
                    </div>
                    <button type="submit" id="btun3" class="btn btn-success">Continue</button>
                </form>

            </div>
        </div>
    </div>
</div>
<div class="modal bottom fade" style="overflow-y: scroll;" id="ReceipteModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="ti-close text-grey-500"></i></button>
            <div class="modal-body p-3 d-flex align-items-center bg-none">
                <div class="card shadow-none rounded-0 w-100 p-2 pt-3 border-0">
                    <div class="card-body rounded-0 text-left p-3">
                        <h2 class="fw-700 display1-size display2-md-size mb-4">Receipte</h2>
                        <form id="reserveForm" >

                           <div id="resetdiv">
                           </div>
                            <div class="form-group mb-1">
                                <input type="submit" value="Pay"  class="form-control text-center style2-input text-white fw-600 bg-dark border-0 p-0 ">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
