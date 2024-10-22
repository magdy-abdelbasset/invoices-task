<tr id="row-table-{{ $invoice->id }}"
    class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
    <td class="px-6 py-4 ">
        {{ $invoice->number }}
    </td>
    <td class="px-6 py-4 ">
        {{ $invoice->client->name }}
        <br/>
        {{ $invoice->client->email }}

        <br/>
        {{ $invoice->client->phone }}
    </td>  
    <td class="px-6 py-4 image-container">
        
        {{ $invoice->date}}
    </td>
    <td class="px-6 py-4 ">
        
        {{ $invoice->due_date}}
    </td>
    <th class="px-6 py-4 ">
        
        {{ $invoice->total_amount}}
    </th>
    
    <td class="px-6 py-4 image-container">

            <a  href="{{ route('dashboard.invoices.show', $invoice->id) }}"
                 type="button">
                Show
            </a>
    </td>
</tr>
