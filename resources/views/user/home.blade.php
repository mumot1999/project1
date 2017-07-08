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

                    <button type="button" class="btn btn-primary btn-lg btn-block">Get Free Coins</button>
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
                                    <th>Time</th>
                                    <th>Price</th>
                                    <th>Actual likes</th>
                                    <th>Target likes</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                                <tr>

                                    <td><h4>10/21/2013</td>
                                    <td><h4>3:29 PM</td>
                                    <td><h4>10</td>
                                    <td><h4>12</td>
                                    <td><h4>200</td>
                                    <td >
                                      <!-- <div class='col-lg-push-10'> -->
                                       <button type="button" class="btn btn-default"> Info </button>
                                       <button type="button" class="btn btn-danger"><i class="fa fa-minus-square"> </i> Cancel </button>
                                     <!-- </div> -->
                                    </td>
                                </tr>

                            </tbody>
                        </table>


                    </div>

                    <div class="text-right">
                      <button type="button pull-right" class="btn btn-success"><i class="fa fa-plus-square"> </i> Make New Order </button>
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
                    <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> Recently Orders</h3>
                </div>

                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Price</th>
                                    <th>Actual likes</th>
                                    <th>Target likes</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                                <tr>

                                    <td><h4>10/21/2013</td>
                                    <td><h4>3:29 PM</td>
                                    <td><h4>10</td>
                                    <td><h4>12</td>
                                    <td><h4>200</td>
                                    <td >
                                      <!-- <div class='col-lg-push-10'> -->
                                       <button type="button" class="btn btn-default"> Info </button>
                                       <button type="button" class="btn btn-danger"><i class="fa fa-minus-square"> </i> Cancel </button>
                                     <!-- </div> -->
                                    </td>
                                </tr>

                            </tbody>
                        </table>


                    </div>

                    <div class="text-right">
                      <button type="button pull-right" class="btn btn-success"><i class="fa fa-plus-square"> </i> Make New Order </button>
                      <button type="button pull-right" class="btn btn-default"><i class="fa fa-arrow-circle-right"></i> See All Orders </button>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- /.row -->

</div>
@endsection
