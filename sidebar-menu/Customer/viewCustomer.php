<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer List</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <div class="container mx-auto p-8">
        <div class="bg-white shadow-md rounded p-6">
            <h2 class="text-2xl font-bold mb-4">Customer List</h2>

            <div class="flex justify-between mb-4">
                <div>
                    <label for="entries" class="text-gray-700">Show</label>
                    <select id="entries" class="border border-gray-300 rounded px-3 py-1">
                        <option value="10">10</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    <span class="text-gray-700">Entries</span>
                </div>
                <div>
                    <input type="text" id="search" class="border border-gray-300 rounded px-3 py-1" placeholder="Search by name or phone">
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="table-auto w-full text-left">
                    <thead>
                        <tr class="bg-gray-200 text-gray-700">
                            <th class="px-4 py-2">#</th>
                            <th class="px-4 py-2">Customer Name</th>
                            <th class="px-4 py-2">Mobile Number</th>
                            <th class="px-4 py-2">GSTIN</th>
                            <th class="px-4 py-2">Action</th>
                        </tr>
                    </thead>
                    <tbody id="customerTable">
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
</html>
