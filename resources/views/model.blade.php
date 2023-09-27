                <form class="formvalidate" method="POST" id="form2">
                    @csrf
                <div>
                    <div class="form-group">
                        <div>
                        <input type="checkbox"   name="completed" {{$task->completed == 0 ? '' : 'checked'}}
                             @if ('checked')
                                value="1"
                            @endif>
                            Mark as Complete
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="title" name="title" value="{{$task->title}}" placeholder="Write Task Title">
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" id="notes" name="notes" placeholder="Write Task Notes">{{$task->notes}}</textarea>
                    </div>
                    <div class="form-group">
                        <input type="date" class="form-control" id="date" name="date" value="{{$task->date}}">
                    </div>
                    <div class="modal-footer">
                        <button type="button" value='{{ $task->id }}' id="update_task" class="btn btn-success">Update</button>
                        <button type="button" id="closeModal2" class="btn btn-secondary" data-dismiss="modal">
                            Close
                        </button>
                    </div>
                </div>
                </form>



