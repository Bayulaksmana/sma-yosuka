            @foreach ($article as $item)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $item->title }}</td>
                    <td>{{ $item->category->name }}</td>
                    <td>{{ $item->description }}</td>
                    @if ($item->status == 0)
                        <td class="text-center">
                            <span class="badge bg-danger">Not-Published</span>
                        </td>
                    @else
                        <td class="text-center">
                            <span class="badge bg-success">Published</span>
                        </td>
                    @endif
                    <td class="text-center">{{ $item->publish_date }}</td>
                    <td class="bi bi-person-lines-fill text-center"> {{ $item->views }}</td>
                    <td class="text-center">
                        <a href="" class="btn btn-info"><i class="bi bi-info-circle-fill"></i></a>
                        <a href="" class="btn btn-success"><i class="bi bi-pencil-square"></i></a>
                        <a href="" class="btn btn-warning"><i class="bi bi-trash3-fill"></i></a>
                    </td>
                </tr>
            @endforeach
