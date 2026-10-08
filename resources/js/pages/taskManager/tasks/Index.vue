<script setup lang="ts">
import { Plus, Search, X, Pencil, Trash2, CheckCircle2 } from '@lucide/vue'
import { toast } from 'vue-sonner'
import { Button } from '@/components/ui/button'
import { Input } from '@/components/ui/input'
import { ref } from 'vue'
import {
    Select, SelectContent, SelectItem, SelectTrigger, SelectValue,
} from '@/components/ui/select'
import {
    Table, TableCell, TableHead, TableHeader, TableRow,
} from '@/components/ui/table'
import { useForm, Link } from '@inertiajs/vue3'
import draggable from 'vuedraggable'

const markTaskComplete = ref(false)
function toggleComplete() {
    markTaskComplete.value = !markTaskComplete.value

}
// getting the add modal
const showAddTaskModal = ref(false)

function addTaskModal() {
    showAddTaskModal.value = true
}
// close
function closeAddTaskModal() {
    showAddTaskModal.value = false
}
// Edit
const showEditTaskModal = ref(false)

function editTaskModal() {
    showEditTaskModal.value = true
}
// close
function closeEditTaskModal() {
    showEditTaskModal.value = false
}
// Delete
const showDeleteTaskModal = ref(false)
function deleteTaskModal() {
    showDeleteTaskModal.value = true
}
// close
function closeDeleteTaskModal() {
    showDeleteTaskModal.value = false
}
//interface for status
interface status {
    value: string
    label: string
}
interface Task {
    id: number
    title: string
    description: string | null
    status: string
    priority: string
    due_date: string
}
interface PaginationLink {
    url: string | null
    label: string
    active: boolean
}
interface PaginatedTasks {
    data: Task[]
    current_page: number
    last_page: number
    per_page: number
    total: number
    from: number | null
    to: number | null
    links: PaginationLink[]
}
const props = defineProps<{
    tasks: PaginatedTasks,
    statuses: status[]
}>()
//list from paginated tasks
const taskList = ref([...props.tasks.data])
// Form Inputs
const form = useForm({
    title: '',
    description: '',
    status: 'pending',
    priority: 'medium',
    due_date: '',
})
function addTask() {
    form.post('/tasks', {
        onSuccess: (page) => {
            showAddTaskModal.value = false
            form.reset()

            const message = (page.props.flash as { success?: string })?.success


            if (message) {
                toast.success(message)
            }
        },
    })
}
</script>

<template>
    <div class="p-6 space-y-6">

        <!-- Page header -->
        <div class="flex items-center justify-between">

            <div>
                <h1 class="text-2xl font-semibold tracking-tight">
                    All Tasks
                </h1>

                <p class="text-sm text-muted-foreground">
                    View and manage all your <b class="text-red-600">{{ props.tasks.total }}</b> tasks
                </p>
            </div>

            <Button @click="addTaskModal()">
                <Plus class="mr-2 h-4 w-4" />
                Add Task
            </Button>

        </div>


        <!-- Filters card -->
        <div class="rounded-xl border bg-card p-6">

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">

                <div class="space-y-1.5">

                    <div class="relative">

                        <Search
                            class="pointer-events-none absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-muted-foreground" />

                        <Input placeholder="Search tasks..." class="pl-9" />

                    </div>

                </div>


                <div class="space-y-1.5">

                    <Select>

                        <SelectTrigger>
                            <SelectValue placeholder="All Priorities" />
                        </SelectTrigger>

                        <SelectContent>

                            <SelectItem value="all">
                                All status
                            </SelectItem>

                            <SelectItem value="low">
                                Low
                            </SelectItem>

                            <SelectItem value="normal">
                                Normal
                            </SelectItem>

                            <SelectItem value="high">
                                High
                            </SelectItem>

                        </SelectContent>

                    </Select>

                </div>
                <div class="space-y-1.5">

                    <Select>

                        <SelectTrigger>
                            <SelectValue placeholder="All Priorities" />
                        </SelectTrigger>

                        <SelectContent>

                            <SelectItem value="all">
                                All Priorities
                            </SelectItem>

                            <SelectItem value="low">
                                Low
                            </SelectItem>

                            <SelectItem value="normal">
                                Normal
                            </SelectItem>

                            <SelectItem value="high">
                                High
                            </SelectItem>

                        </SelectContent>

                    </Select>

                </div>

            </div>

        </div>


        <!-- Tasks card -->

        <div class="rounded-xl border bg-card">

            <div class="border-b p-6 pb-4">

            </div>


            <Table>

                <TableHeader>

                    <TableRow>

                        <TableHead>
                            Title
                        </TableHead>

                        <TableHead>
                            Description
                        </TableHead>
                        <TableHead>
                            Status
                        </TableHead>

                        <TableHead>
                            Priority
                        </TableHead>

                        <TableHead class="text-right">
                            Actions
                        </TableHead>

                    </TableRow>

                </TableHeader>


                <draggable v-model="props.tasks.data" item-key="id" tag="tbody">
                    <template #item="{ element: task }">
                        <TableRow :key="task.id">



                            <TableCell :class="task.status === 'completed' ? 'line-through text-muted-foreground' : ''">
                                <div class="flex items-center gap-3">

                                    <button type="button" @click="toggleComplete"
                                        class="flex h-5 w-5 shrink-0 items-center justify-center rounded-full border border-muted-foreground/40">
                                        <CheckCircle2 v-if="markTaskComplete" class="h-4 w-4" />
                                    </button>

                                    <span class="font-medium">
                                        {{ task.title }}
                                    </span>

                                </div>
                            </TableCell>

                            <TableCell class="text-muted-foreground">
                                {{ task.description || 'No description' }}
                            </TableCell>

                            <TableCell>
                                {{ task.status }}
                            </TableCell>

                            <TableCell>
                                <span
                                    class="inline-flex items-center rounded-md px-2 py-0.5 text-xs font-medium capitalize bg-red-500 text-white">
                                    {{ task.priority }}
                                </span>
                            </TableCell>


                            <TableCell class="text-right">
                                <div class="flex items-center justify-end gap-3">

                                    <button type="button" class="text-muted-foreground hover:text-foreground"
                                        @click="editTaskModal">
                                        <Pencil class="h-4 w-4" />
                                    </button>

                                    <button type="button" class="text-muted-foreground hover:text-destructive"
                                        @click="deleteTaskModal">
                                        <Trash2 class="h-4 w-4" />
                                    </button>

                                </div>
                            </TableCell>
                        </TableRow>
                    </template>
                </draggable>



            </Table>
            <div class="flex items-center justify-between border-t p-4">
                <p class="text-sm text-muted-foreground">
                    Showing {{ props.tasks.from }} to {{ props.tasks.to }}
                    of {{ props.tasks.total }} tasks
                </p>

                <div class="flex items-center gap-2">
                    <Link v-for="link in props.tasks.links" :key="link.label" :href="link.url ?? '#'" :class="[
                        'rounded-md border px-3 py-1.5 text-sm',
                        link.active
                            ? 'bg-gray-900 text-white'
                            : 'hover:bg-gray-100',
                        !link.url
                            ? 'pointer-events-none opacity-50'
                            : ''
                    ]" v-html="link.label" />
                </div>
            </div>

        </div>

    </div>



    <!-- Add Task Modal -->

    <div v-if="showAddTaskModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-4">

        <div class="w-full max-w-md rounded-xl border bg-white shadow-lg">


            <!-- Modal Header -->

            <div class="flex items-center justify-between border-b p-5">

                <div>

                    <h2 class="text-lg font-semibold">
                        Add Task
                    </h2>

                    <p class="text-sm text-muted-foreground text-gray-500">
                        Create a new task in your list.
                    </p>

                </div>


                <button type="button" class="text-gray-400 hover:text-gray-700" @click="closeAddTaskModal">
                    <X class="h-5 w-5" />
                </button>

            </div>



            <!-- Add Task Form -->

            <form class="space-y-4 p-5" @submit.prevent="addTask">


                <!-- Title -->

                <div class="space-y-1.5">

                    <label class="text-sm font-medium">
                        Title
                    </label>

                    <input type="text" placeholder="Task title" v-model="form.title"
                        class="w-full rounded-md border px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-gray-400" />

                </div>



                <!-- Description -->

                <div class="space-y-1.5">

                    <label class="text-sm font-medium">
                        Description
                    </label>

                    <textarea rows="3" placeholder="Optional description" v-model="form.description"
                        class="w-full rounded-md border px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-gray-400"></textarea>

                </div>



                <!-- Due Date -->

                <div class="space-y-1.5">

                    <label class="text-sm font-medium">
                        Due Date
                    </label>

                    <input type="date" v-model="form.due_date"
                        class="w-full rounded-md border px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-gray-400" />

                </div>



                <!-- Priority -->

                <div class="grid grid-cols-2 gap-4">

                    <!-- Priority -->
                    <div class="space-y-1.5">
                        <label class="text-sm font-medium">
                            Priority
                        </label>

                        <select v-model="form.priority"
                            class="w-full rounded-md border bg-white px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-gray-400">
                            <option value="low">Low</option>
                            <option value="medium">Normal</option>
                            <option value="high">High</option>
                        </select>
                    </div>

                    <!-- Status -->
                    <div class="space-y-1.5">
                        <label class="text-sm font-medium">
                            Status
                        </label>

                        <select v-model="form.status"
                            class="w-full rounded-md border bg-white px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-gray-400">
                            <option v-for="status in props.statuses" :key="status.value" :value="status.value">{{
                                status.label }}
                            </option>

                        </select>
                    </div>

                </div>



                <!-- Buttons -->

                <div class="flex justify-end gap-2 border-t pt-4">

                    <button type="button" class="rounded-md border px-4 py-2 text-sm hover:bg-gray-50"
                        @click="closeAddTaskModal">
                        Cancel
                    </button>


                    <button type="submit" class="rounded-md bg-gray-900 px-4 py-2 text-sm text-white hover:bg-gray-800">
                        Add Task
                    </button>

                </div>

            </form>

        </div>

    </div>



    <!-- Edit Task Modal -->

    <div v-if="showEditTaskModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-4">

        <div class="w-full max-w-md rounded-xl border bg-white shadow-lg">


            <div class="flex items-center justify-between border-b p-5">

                <div>

                    <h2 class="text-lg font-semibold">
                        Edit Task
                    </h2>

                    <p class="text-sm text-gray-500">
                        Update the details of this task.
                    </p>

                </div>


                <button type="button" class="text-gray-400 hover:text-gray-700" @click="closeEditTaskModal">
                    <X class="h-5 w-5" />
                </button>

            </div>


            <form class="space-y-4 p-5">


                <div class="space-y-1.5">

                    <label class="text-sm font-medium">
                        Title
                    </label>

                    <input type="text" value="Run 5km without stopping"
                        class="w-full rounded-md border px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-gray-400" />

                </div>


                <div class="space-y-1.5">

                    <label class="text-sm font-medium">
                        Description
                    </label>

                    <textarea rows="3"
                        class="w-full rounded-md border px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-gray-400">Build
                    stamina gradually</textarea>

                </div>


                <div class="grid grid-cols-2 gap-4">

                    <div class="space-y-1.5">

                        <label class="text-sm font-medium">
                            Priority
                        </label>

                        <select
                            class="w-full rounded-md border bg-white px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-gray-400">

                            <option value="low">
                                Low
                            </option>

                            <option value="normal">
                                Normal
                            </option>

                            <option value="high" selected>
                                High
                            </option>

                        </select>

                    </div>

                </div>


                <div class="flex items-center gap-2">

                    <input id="editTaskCompleted" type="checkbox" class="h-4 w-4 rounded border-gray-300" />

                    <label for="editTaskCompleted" class="text-sm">
                        Mark as completed
                    </label>

                </div>


                <div class="flex justify-end gap-2 border-t pt-4">

                    <button type="button" class="rounded-md border px-4 py-2 text-sm hover:bg-gray-50"
                        @click="closeEditTaskModal">
                        Cancel
                    </button>

                    <button type="submit" class="rounded-md bg-gray-900 px-4 py-2 text-sm text-white hover:bg-gray-800">
                        Save Changes
                    </button>

                </div>

            </form>

        </div>

    </div>



    <!-- Delete Task Modal -->

    <div v-if="showDeleteTaskModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-4">

        <div class="w-full max-w-sm rounded-xl border bg-white p-5 shadow-lg">

            <h2 class="text-lg font-semibold">
                Delete task?
            </h2>


            <p class="mt-1 text-sm text-gray-500">

                This will permanently delete

                <span class="font-medium text-gray-900">
                    "Run 5km without stopping"
                </span>.

                This action cannot be undone.

            </p>


            <div class="mt-5 flex justify-end gap-2">

                <button type="button" class="rounded-md border px-4 py-2 text-sm hover:bg-gray-50"
                    @click="closeDeleteTaskModal">
                    Cancel
                </button>


                <button type="button" class="rounded-md bg-red-500 px-4 py-2 text-sm text-white hover:bg-red-600">
                    Delete Task
                </button>

            </div>

        </div>

    </div>

</template>
