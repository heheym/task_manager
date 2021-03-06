<div class="col-3 my-3">
    <div class="card project-card">
        <ul class="icon-bar">
            <li>
                @include('projects._deleteForm')
            </li>
            <li>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editProjectModal-{{$project->id}}">
                    <i class="fa fa-btn fa-cog"></i>
                </button>
            </li>
        </ul>
        <a href="{{route('projects.show', $project->id)}}">
            <img class="card-img-top" src="{{asset('storage/thumbs/cropped/' . $project->thumbnail)}}"
                 alt="Card image cap">
            <div class="card-body py-3">
                <h6 class="card-title text-center">{{$project->name}}</h6>
            </div>
        </a>
    </div>
    @include('projects._editModal')
</div>