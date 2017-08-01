<div class="panel panel-default">
  <div class="panel-heading">
    Customers feedback
  </div>

      <table class="table">
        <tbody>
          @foreach($feedbacks as $feedback)
          <tr>
            <td></td>
            <td>{{ $feedback->name }}</td>
            <td>{{ $feedback->feedback }}</td>
            <td>{{ $feedback->created_at }}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
</div>

<div class="pull-right">
  {{ $feedbacks->links() }}
</div>
