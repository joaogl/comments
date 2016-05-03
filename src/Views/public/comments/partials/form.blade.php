
<!-- Comments Form -->
<div class="well">
    <h4>Leave a Comment:</h4>

    {!! Form::model(null, array('route' => array('comment.post', $post->id))) !!}

    <div class="form-group">
        <div class="row">
            <div class="col-md-12 {{ $errors->first('comment', 'has-error') }}">
                {!! Form::textarea('comment', null, ['class' => 'form-control', 'placeholder' => 'Comment']) !!}
                <span class="help-block">{{ $errors->first('comment', ':message') }}</span>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="row">
            <div class="col-md-offset-10 col-md-2">
                {!! Form::submit('Submit', ['class' => 'btn btn-primary form-control']) !!}
            </div>
        </div>
    </div>

    {!! Form::close() !!}

</div>
