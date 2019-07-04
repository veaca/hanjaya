<td><a href="{{ route('customer.edit',$customer->id)}}" class="btn btn-primary">Edit</a></td>
            <td>
                <form action="{{ route('customer.destroy', $customer->id)}}" method="post">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger" type="submit">Delete</button>
                </form>
            </td>