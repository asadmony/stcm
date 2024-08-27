@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Add New Traffic Area</h3>
                </div>
                @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                <!-- form start -->

              <form>
                <div class="card-body">
                  <div class="form-group">
                    <label>Traffic Zone</label>
                    <select class="form-control select2" style="width: 100%;">
                        <option selected="selected">Mirpur</option>
                        <option>Dhanmondi</option>
                        <option>Agargaon</option>
                        <option>Farmgate</option>
                        <option>Shahbag</option>
                        <option>Mohakhali</option>
                        <option>Badda</option>
                    </select>
                  </div>
                  <h6 class="text-bold">Slots Requirement</h6>
                  <div class="form-group">
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Point 1</label>
                        <div class="col-sm-10">
                          <input type="number" class="form-control" id="inputEmail3" placeholder="10">
                        </div>
                      </div>
                  </div>
                  <div class="form-group">
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Point 2</label>
                        <div class="col-sm-10">
                          <input type="number" class="form-control" id="inputEmail3" placeholder="10">
                        </div>
                      </div>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
        </div>
        <div class="col-md-6">

            <div class="card card-success">
                <div class="card-header">
                  <h3 class="card-title success">Traffic Area List</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th style="width: 10px">#</th>
                        <th>Task</th>
                        <th>Progress</th>
                        <th style="width: 40px">Label</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>1.</td>
                        <td>Update software</td>
                        <td>
                          <div class="progress progress-xs">
                            <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                          </div>
                        </td>
                        <td><span class="badge bg-danger">55%</span></td>
                      </tr>
                      <tr>
                        <td>2.</td>
                        <td>Clean database</td>
                        <td>
                          <div class="progress progress-xs">
                            <div class="progress-bar bg-warning" style="width: 70%"></div>
                          </div>
                        </td>
                        <td><span class="badge bg-warning">70%</span></td>
                      </tr>
                      <tr>
                        <td>3.</td>
                        <td>Cron job running</td>
                        <td>
                          <div class="progress progress-xs progress-striped active">
                            <div class="progress-bar bg-primary" style="width: 30%"></div>
                          </div>
                        </td>
                        <td><span class="badge bg-primary">30%</span></td>
                      </tr>
                      <tr>
                        <td>4.</td>
                        <td>Fix and squish bugs</td>
                        <td>
                          <div class="progress progress-xs progress-striped active">
                            <div class="progress-bar bg-success" style="width: 90%"></div>
                          </div>
                        </td>
                        <td><span class="badge bg-success">90%</span></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
</div>
@endsection
