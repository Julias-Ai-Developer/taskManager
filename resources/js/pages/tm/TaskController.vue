<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import PlaceholderPattern from '@/components/PlaceholderPattern.vue';
import { dashboard, task } from '@/routes';

defineOptions({
    layout: {
        breadcrumbs: [
            {
                title: 'Tasks',
                href: task(),
            },
        ],
    },
});
</script>
<template>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>All Tasks</title>

  <script src="https://cdn.tailwindcss.com"></script>

  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            primary: "#111827"
          }
        }
      }
    }
  </script>
</head>

<body class="bg-white text-gray-900 antialiased">

  <main class="min-h-screen p-2 sm:p-4">

    <!-- Header -->
    <div class="mb-4 flex items-start justify-between">

      <div>
        <h1 class="text-lg font-semibold text-gray-900">
          All Tasks
        </h1>

        <p class="text-[11px] text-gray-500">
          View and manage all your tasks (4 total)
        </p>
      </div>

      <!-- Add Task -->
      <button
        class="flex items-center gap-2 rounded-md bg-gray-950 px-3 py-2
               text-[10px] font-medium text-white shadow-sm
               hover:bg-gray-800 transition"
      >
        <span class="text-sm leading-none">+</span>
        Add Task
      </button>

    </div>


    <!-- Filters Card -->
    <section class="rounded-xl border border-gray-200 bg-white px-4 py-4 shadow-sm">

      <!-- Filter header -->
      <div class="mb-4 flex items-center justify-between">

        <h2 class="text-[11px] font-semibold text-gray-800">
          Filters
        </h2>

        <button
          class="flex items-center gap-2 text-[10px] text-gray-600 hover:text-gray-900"
        >
          <span class="text-sm">×</span>
          Clear Filters
        </button>

      </div>


      <!-- Filter fields -->
      <div class="grid grid-cols-1 gap-3 md:grid-cols-3">

        <!-- Search -->
        <div>
          <label class="mb-1.5 block text-[10px] font-medium text-gray-700">
            Search
          </label>

          <div class="relative">
            <span
              class="absolute left-2.5 top-1/2 -translate-y-1/2
                     text-gray-400"
            >
              <!-- Search icon -->
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-3.5 w-3.5"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="2"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  d="m21 21-4.35-4.35m2.1-5.4a7.5 7.5 0 1 1-15 0 7.5 7.5 0 0 1 15 0Z"
                />
              </svg>
            </span>

            <input
              type="text"
              placeholder="Search tasks..."
              class="h-8 w-full rounded-md border border-gray-200
                     bg-white pl-8 pr-3 text-[10px] text-gray-700
                     outline-none placeholder:text-gray-400
                     focus:border-gray-400 focus:ring-1 focus:ring-gray-200"
            />
          </div>
        </div>


        <!-- List -->
        <div>
          <label class="mb-1.5 block text-[10px] font-medium text-gray-700">
            List
          </label>

          <select
            class="h-8 w-full rounded-md border border-gray-200
                   bg-white px-2 text-[10px] text-gray-700 outline-none
                   focus:border-gray-400 focus:ring-1 focus:ring-gray-200"
          >
            <option>Work Projects</option>
            <option>Personal</option>
            <option>Shopping</option>
          </select>
        </div>


        <!-- Priority -->
        <div>
          <label class="mb-1.5 block text-[10px] font-medium text-gray-700">
            Priority
          </label>

          <select
            class="h-8 w-full rounded-md border border-gray-200
                   bg-white px-2 text-[10px] text-gray-700 outline-none
                   focus:border-gray-400 focus:ring-1 focus:ring-gray-200"
          >
            <option>All Priorities</option>
            <option>High</option>
            <option>Normal</option>
            <option>Low</option>
          </select>
        </div>

      </div>
    </section>


    <!-- Tasks Table -->
    <section class="mt-4 overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">

      <!-- Table header -->
      <div class="px-4 pt-4">

        <h2 class="text-[11px] font-semibold text-gray-800">
          Tasks (4 of 4)
        </h2>

      </div>


      <div class="mt-3 overflow-x-auto">
        <table class="w-full min-w-[650px] border-collapse">

          <!-- Head -->
          <thead>
            <tr class="border-b border-gray-100">

              <th
                class="px-3 py-2 text-left text-[9px] font-medium
                       text-gray-500"
              >
                Title
              </th>

              <th
                class="px-3 py-2 text-left text-[9px] font-medium
                       text-gray-500"
              >
                Description
              </th>

              <th
                class="px-3 py-2 text-left text-[9px] font-medium
                       text-gray-500"
              >
                List
              </th>

              <th
                class="px-3 py-2 text-left text-[9px] font-medium
                       text-gray-500"
              >
                Priority
              </th>

              <th
                class="px-3 py-2 text-left text-[9px] font-medium
                       text-gray-500"
              >
                Actions
              </th>

            </tr>
          </thead>


          <!-- Body -->
          <tbody>

            <!-- Task 1 -->
            <tr class="border-b border-gray-100 hover:bg-gray-50">

              <td class="px-3 py-3">
                <div class="flex items-center gap-2">

                  <button
                    class="flex h-3 w-3 items-center justify-center
                           rounded-full border border-green-500
                           text-green-500"
                  >
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      class="h-2 w-2"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke="currentColor"
                      stroke-width="3"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="m5 12 4 4L19 6"
                      />
                    </svg>
                  </button>

                  <span class="text-[10px] text-gray-400 line-through">
                    Finish QA report
                  </span>

                </div>
              </td>

              <td class="px-3 py-3 text-[10px] text-gray-400 line-through">
                Due Friday EOD
              </td>

              <td class="px-3 py-3">
                <div class="flex items-center gap-2 text-[10px] text-gray-700">
                  <span class="h-2 w-2 rounded-full bg-blue-500"></span>
                  Work Projects
                </div>
              </td>

              <td class="px-3 py-3">
                <span
                  class="rounded-md bg-red-500 px-2 py-0.5
                         text-[8px] font-semibold text-white"
                >
                  high
                </span>
              </td>

              <td class="px-3 py-3">
                <div class="flex items-center gap-3">

                  <!-- Edit -->
                  <button class="text-gray-600 hover:text-gray-900">
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      class="h-3.5 w-3.5"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke="currentColor"
                      stroke-width="1.8"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="m16.862 3.487 3.651 3.651M5 19l3.5-.5L19.5 7.5a2.121 2.121 0 0 0-3-3L5.5 15.5 5 19Z"
                      />
                    </svg>
                  </button>

                  <!-- Delete -->
                  <button class="text-gray-600 hover:text-red-500">
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      class="h-3.5 w-3.5"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke="currentColor"
                      stroke-width="1.8"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M4 7h16M10 11v6M14 11v6M6 7l1 13h10l1-13M9 7V4h6v3"
                      />
                    </svg>
                  </button>

                </div>
              </td>

            </tr>


            <!-- Task 2 -->
            <tr class="border-b border-gray-100 hover:bg-gray-50">

              <td class="px-3 py-3">
                <div class="flex items-center gap-2">

                  <button
                    class="h-3 w-3 rounded-full border border-gray-500"
                  ></button>

                  <span class="text-[10px] text-gray-800">
                    Deploy new landing page
                  </span>

                </div>
              </td>

              <td class="px-3 py-3 text-[10px] text-gray-500">
                Work with design team
              </td>

              <td class="px-3 py-3">
                <div class="flex items-center gap-2 text-[10px] text-gray-700">
                  <span class="h-2 w-2 rounded-full bg-blue-500"></span>
                  Work Projects
                </div>
              </td>

              <td class="px-3 py-3">
                <span
                  class="rounded-md bg-red-500 px-2 py-0.5
                         text-[8px] font-semibold text-white"
                >
                  high
                </span>
              </td>

              <td class="px-3 py-3">
                <div class="flex items-center gap-3">

                  <button class="text-gray-600 hover:text-gray-900">
                    <svg xmlns="http://www.w3.org/2000/svg"
                      class="h-3.5 w-3.5" fill="none"
                      viewBox="0 0 24 24" stroke="currentColor"
                      stroke-width="1.8">
                      <path stroke-linecap="round"
                        stroke-linejoin="round"
                        d="m16.862 3.487 3.651 3.651M5 19l3.5-.5L19.5 7.5a2.121 2.121 0 0 0-3-3L5.5 15.5 5 19Z"/>
                    </svg>
                  </button>

                  <button class="text-gray-600 hover:text-red-500">
                    <svg xmlns="http://www.w3.org/2000/svg"
                      class="h-3.5 w-3.5" fill="none"
                      viewBox="0 0 24 24" stroke="currentColor"
                      stroke-width="1.8">
                      <path stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M4 7h16M10 11v6M14 11v6M6 7l1 13h10l1-13M9 7V4h6v3"/>
                    </svg>
                  </button>

                </div>
              </td>

            </tr>


            <!-- Task 3 -->
            <tr class="border-b border-gray-100 hover:bg-gray-50">

              <td class="px-3 py-3">
                <div class="flex items-center gap-2">

                  <button
                    class="flex h-3 w-3 items-center justify-center
                           rounded-full border border-green-500
                           text-green-500"
                  >
                    <svg xmlns="http://www.w3.org/2000/svg"
                      class="h-2 w-2" fill="none"
                      viewBox="0 0 24 24"
                      stroke="currentColor"
                      stroke-width="3">
                      <path stroke-linecap="round"
                        stroke-linejoin="round"
                        d="m5 12 4 4L19 6"/>
                    </svg>
                  </button>

                  <span class="text-[10px] text-gray-400 line-through">
                    Fix login bug
                  </span>

                </div>
              </td>

              <td class="px-3 py-3 text-[10px] text-gray-400 line-through">
                Users reporting 500 error
              </td>

              <td class="px-3 py-3">
                <div class="flex items-center gap-2 text-[10px] text-gray-700">
                  <span class="h-2 w-2 rounded-full bg-blue-500"></span>
                  Work Projects
                </div>
              </td>

              <td class="px-3 py-3">
                <span
                  class="rounded-md bg-red-500 px-2 py-0.5
                         text-[8px] font-semibold text-white"
                >
                  high
                </span>
              </td>

              <td class="px-3 py-3">
                <div class="flex items-center gap-3">

                  <button class="text-gray-600 hover:text-gray-900">
                    <svg xmlns="http://www.w3.org/2000/svg"
                      class="h-3.5 w-3.5" fill="none"
                      viewBox="0 0 24 24" stroke="currentColor"
                      stroke-width="1.8">
                      <path stroke-linecap="round"
                        stroke-linejoin="round"
                        d="m16.862 3.487 3.651 3.651M5 19l3.5-.5L19.5 7.5a2.121 2.121 0 0 0-3-3L5.5 15.5 5 19Z"/>
                    </svg>
                  </button>

                  <button class="text-gray-600 hover:text-red-500">
                    <svg xmlns="http://www.w3.org/2000/svg"
                      class="h-3.5 w-3.5" fill="none"
                      viewBox="0 0 24 24" stroke="currentColor"
                      stroke-width="1.8">
                      <path stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M4 7h16M10 11v6M14 11v6M6 7l1 13h10l1-13M9 7V4h6v3"/>
                    </svg>
                  </button>

                </div>
              </td>

            </tr>


            <!-- Task 4 -->
            <tr class="hover:bg-gray-50">

              <td class="px-3 py-3">
                <div class="flex items-center gap-2">

                  <button
                    class="flex h-3 w-3 items-center justify-center
                           rounded-full border border-green-500
                           text-green-500"
                  >
                    <svg xmlns="http://www.w3.org/2000/svg"
                      class="h-2 w-2" fill="none"
                      viewBox="0 0 24 24"
                      stroke="currentColor"
                      stroke-width="3">
                      <path stroke-linecap="round"
                        stroke-linejoin="round"
                        d="m5 12 4 4L19 6"/>
                    </svg>
                  </button>

                  <span class="text-[10px] text-gray-400 line-through">
                    Code review PR #142
                  </span>

                </div>
              </td>

              <td class="px-3 py-3 text-[10px] text-gray-400">
                -
              </td>

              <td class="px-3 py-3">
                <div class="flex items-center gap-2 text-[10px] text-gray-700">
                  <span class="h-2 w-2 rounded-full bg-blue-500"></span>
                  Work Projects
                </div>
              </td>

              <td class="px-3 py-3">
                <span
                  class="rounded-md bg-gray-900 px-2 py-0.5
                         text-[8px] font-semibold text-white"
                >
                  normal
                </span>
              </td>

              <td class="px-3 py-3">
                <div class="flex items-center gap-3">

                  <button class="text-gray-600 hover:text-gray-900">
                    <svg xmlns="http://www.w3.org/2000/svg"
                      class="h-3.5 w-3.5" fill="none"
                      viewBox="0 0 24 24" stroke="currentColor"
                      stroke-width="1.8">
                      <path stroke-linecap="round"
                        stroke-linejoin="round"
                        d="m16.862 3.487 3.651 3.651M5 19l3.5-.5L19.5 7.5a2.121 2.121 0 0 0-3-3L5.5 15.5 5 19Z"/>
                    </svg>
                  </button>

                  <button class="text-gray-600 hover:text-red-500">
                    <svg xmlns="http://www.w3.org/2000/svg"
                      class="h-3.5 w-3.5" fill="none"
                      viewBox="0 0 24 24"
                      stroke="currentColor"
                      stroke-width="1.8">
                      <path stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M4 7h16M10 11v6M14 11v6M6 7l1 13h10l1-13M9 7V4h6v3"/>
                    </svg>
                  </button>

                </div>
              </td>

            </tr>

          </tbody>

        </table>
      </div>


      <!-- Footer -->
      <div
        class="flex flex-col gap-3 border-t border-gray-100
               px-4 py-3 sm:flex-row sm:items-center sm:justify-between"
      >

        <p class="text-[9px] text-gray-500">
          Showing 4 of 4 tasks
        </p>

        <div class="flex items-center gap-4 text-[9px]">

          <button
            class="text-gray-400 hover:text-gray-800"
          >
            « Previous
          </button>

          <button
            class="flex h-5 w-5 items-center justify-center
                   rounded bg-gray-900 text-[9px] text-white"
          >
            1
          </button>

          <button
            class="text-gray-500 hover:text-gray-900"
          >
            Next »
          </button>

        </div>

      </div>

    </section>

  </main>

</body>
</html>
    </template>