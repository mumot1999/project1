@extends('layouts.user')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Dashboard
            </h1>

        </div>
    </div>
    <!-- /.row -->

    <div class="row">

@if(Auth::user()->instagram_user_id === null)
    <div class="row">
        <div class="col-lg-12">


            <div class=" panel panel-info">

                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> Set your instagram nick</h3>
                </div>

                <div class="panel-body">


                  <form class="form-horizontal" action = {{ route('user.setInstagramNick')}} method = "post">


                  <div class="form-group">
                    <label class="control-label col-sm-2" for="username">Instagram Nick:</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="username" name="username" placeholder="Enter your nickname">
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-default">Submit</button>
                    </div>
                  </div>

                  <input type="hidden" name="_token" value="{{ Session::token() }}">

              </div>
              </form>





            </div>
        </div>
    </div>
@endif

    <div class="row">
        <div class="col-lg-12">


            <div class=" panel panel-default">

                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> Coins</h3>
                </div>

                <div class="panel-body">


                  <div class="col-lg-4 pull-right">
                    <a href="#">
                      <div class="panel panel-primary">
                          <div class="panel-heading">
                              <div class="row">
                                  <div class="col-xs-3">
                                      <i class="fa fa-support fa-5x"></i>
                                  </div>
                                  <div class="col-xs-9 text-right">
                                      <div class="huge">{{ Auth::user()->getCoinsBalance() }}</div>
                                      <div>Coins</div>
                                  </div>
                              </div>
                          </div>

                      </div>
                    </a>
                  </div>

                  <div class="col-lg-3 ">

                    <button type="button" class="btn btn-primary btn-lg btn-block" id="jobInstagram">Get Free Coins</button>
                    <button type="button" class="btn btn-primary btn-lg btn-block">Buy Coins</button>
                  </div>


                </div>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-lg-12">
            <div class="panel panel-default">

                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> Recently Orders</h3>
                </div>

                <div class="panel-body">
                    <div class="table-responsive">

                        <table class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                                                        <!-- <th>Price</th> -->
                                    <th>Actual likes</th>
                                    <th>Target likes</th>
                                    <th>Site</th>
                                    <th>Action</th>
                                    <th>Options</th>

                                </tr>
                            </thead>
                            <tbody>
                                    @foreach($orders as $order)
                                      <tr>
                                        <td><h4>{{ $order->created_at }}</td>
                                        <td><h4>
                                          {{$order->attemptedOrders->where('valid', 1)->count()}}
                                        </td>

                                        <td><h4>{{ $order->score_target }}</td>
                                        <td><h4>{{ $order->site->name }}</td>
                                        <td><h4>{{ $order->action->name }}</td>
                                        <td >
                                          <div class='col-lg-push-10'>
                                           <button type="button" class="btn btn-default"> More info </button>
                                           <a href="{{ route('order.delete', ['post_id' => $order->id]) }}"><button type="button" class="btn btn-danger"><i class="fa fa-minus-square"> </i> Cancel </button></a>
                                          </div>
                                        </td>
                                      </tr>
                                    @endforeach



                            </tbody>
                        </table>


                    </div>

                    <div class="text-right">
                      <button type="button pull-right" class="btn btn-success" data-toggle="modal" data-target="#newOrderModal" id="button1"><i class="fa fa-plus-square"> </i> Make New Order </button>
                      <button type="button pull-right" class="btn btn-default"><i class="fa fa-arrow-circle-right"></i> See All Orders </button>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-lg-12">
            <div class="panel panel-default">

                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> Recently Actions</h3>
                </div>

                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Price</th>
                                    <th>Type</th>
                                    <th>Site</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td><h4>10/21/2013</td>
                                    <td><h4>3:29 PM</td>
                                    <td><h4>10</td>
                                    <td><h4>Like</td>
                                    <td><h4>Facebook</td>
                                    <td >
                                      <!-- <div class='col-lg-push-10'> -->
                                       <button type="button" class="btn btn-danger"><i class="fa fa-minus-square"> </i> Cancel </button>
                                     <!-- </div> -->
                                    </td>
                                </tr>

                            </tbody>
                        </table>


                    </div>

                    <div class="text-right">
                      <button type="button pull-right" class="btn btn-default"><i class="fa fa-arrow-circle-right"></i> See All Actions </button>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- /.row -->

</div>

<!-- Modal -->
<div id="newOrderModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Make New Order</h4>
        </div>
        <div class="modal-body">
            <form class="form-horizontal" action = {{ route('order.make')}} method = "post">


            <div class="form-group">
              <label class="control-label col-sm-2" for="site">Site:</label>
              <div class="col-sm-10">
                <select class="form-control" id="site" name="site">
                  <option>Instagram</option>
                  <option disabled>Facebook - Coming soon!</option>
                  <option disabled>Twitter - Coming soon!</option>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-2" for="site">Action:</label>
              <div class="col-sm-10">
                <select class="form-control" id="action" name="action">
                  <option>Like</option>
                  <option>Follow</option>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-2" for="url">Url:</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="url" name="url" placeholder="Enter url of media">
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-2" for="score_target">Likes:</label>
              <div class="col-sm-10">
                <input type="number" class="form-control" id="score_target" name="score_target">
              </div>
            </div>

            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">Submit</button>
              </div>
            </div>

            <input type="hidden" name="_token" value="{{ Session::token() }}">

        </div>
        </form>

        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </div>

  </div>
</div>

<script>
    var token = '{{ Session::token() }}';
    var urlGetJob = "{{route('order.getJob')}}";
    var urlEndJob = "{{route('attemptedOrders.end')}}";
</script>


@endsection
