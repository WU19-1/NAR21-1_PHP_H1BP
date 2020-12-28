<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHPH1BP</title>
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./style/style.css">
</head>
<body>
    <nav class="bg-blue-300">
        
        <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
            <div class="relative flex items-center justify-between h-16">
                <a href="/">
                    <div class="flex-shrink-0 flex items-center">
                        <img class="hidden lg:block h-8 w-auto" src="./assets/logo.png" alt="Workflow">
                        Developer Helper
                    </div>
                </a>
            </div>
        </div>
    </nav>
    
    <main>
        <div class="max-w-7xl mx-auto px-6">
            <div class="px-6 py-6 sm:px-0">
                <form action="./controller/downloader.php" method="post">
                    <input type="hidden" name="hcount" value="0">
                    <button type="submit" id="submit" class="mt-3 w-full inline-flex justify-center rounded-md border border-green-300 shadow-sm my-4 px-3 py-1 bg-white text-base font-medium text-green-700 hover:bg-green-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Download
                    </button>
                    <table class="table-auto border-collapse border-2 border-green-800 shadow-sm rounded" >
                        <thead>
                            <tr>
                                <th class="border-2 border-light-blue-500 px-2 py-1 text-light-blue-600 font-medium header">HEADER 1</th>
                                <th class="border-2 border-light-blue-500 px-2 py-1 text-light-blue-600 font-medium header">HEADER 2</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="border-2 border-light-blue-500 px-2 py-1 text-light-blue-600 font-medium data">
                                    Insert data here
                                </td>
                                <td class="border-2 border-light-blue-500 px-2 py-1 text-light-blue-600 font-medium data">
                                    Insert data here
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <input type="hidden" name="count" value="0">
                </form>
            </div>
        </div>
    </main>
    
</body>
<script src="./script/csv.js"></script>
</html>