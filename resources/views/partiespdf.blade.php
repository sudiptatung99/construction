<!DOCTYPE html>
<html>

<head>
    <title>Hi</title>
</head>

<body>
    <table>
        <thead>
            <tr>
                <th>
                    <span >Parties</span>
                </th>
                <th >
                    <span >Due Amount</span>
                </th>
            </tr>
        </thead>
        <tbody>
            @if (isset($client))
                @foreach ($client as $key => $client)
                    @php
                        $amount = 0;
                        $reciveamountalldata = 0;
                    @endphp
                    <tr>
                        <td>
                            {{ $client->name }}</td>
                        <td style="display: flex;justify-content: space-between;align-items: center;">
                            @foreach ($client->sale as $item)
                                @php $amount=$amount+$item->total  @endphp
                            @endforeach
                            @if (count($client->reciver) > 0)
                                @foreach ($client->reciver as $itemrecive)
                                    @php $reciveamountalldata =$reciveamountalldata+$itemrecive->amount  @endphp
                                @endforeach
                            @endif
                            Rs. {{ number_format($amount - $reciveamountalldata, 2) }}
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</body>

</html>
