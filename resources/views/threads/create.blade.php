@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create a New Thread</div>

                    <div class="card-body">
                        <article>
                            <div class="body">
                                <form action="{{route('threads.store')}}" method="post" role="form">
                                    @csrf
                                    <legend>Form Title</legend>

                                    <div class="form-group">
                                        <label for="title">Title: </label>
                                        <input type="text" class="form-control" name="title" id="title" placeholder="Input...">
                                    </div>

                                    <div class="form-group">
                                        <label for="body" class="control-label">Body:</label>
                                        <textarea  class="form-control" id="body" name="body" placeholder=""></textarea>

                                    </div>


                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </article>

                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection