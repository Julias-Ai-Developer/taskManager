<script setup lang="ts">
import { Plus, Search, X, Pencil, Trash2 } from '@lucide/vue'
import { Button } from '@/components/ui/button'
import { Input } from '@/components/ui/input'
import {
    Select,
    SelectContent,
    SelectItem,
    SelectTrigger,
    SelectValue,
} from '@/components/ui/select'
import {
    Table,
    TableBody,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from '@/components/ui/table'
import { ref, computed } from 'vue'

interface Task {
    id: number
    title: string
    description: string
    list: string
    listColor: string
    priority: 'low' | 'normal' | 'high'
    completed: boolean
}

const search = ref('')
const listFilter = ref('all')
const priorityFilter = ref('all')

const totalTasks = 28

const tasks: Task[] = [
    {
        id: 1,
        title: 'test',
        description: 'test',
        list: 'Shopping List',
        listColor: 'bg-emerald-500',
        priority: 'normal',
        completed: false,
    },
    {
        id: 2,
        title: 'Run 5km without stopping',
        description: 'Build stamina gradually',
        list: 'Personal Goals',
        listColor: 'bg-violet-500',
        priority: 'high',
        completed: false,
    },
    {
        id: 3,
        title: 'Read 24 books this year',
        description: '2 books per month',
        list: 'Personal Goals',
        listColor: 'bg-violet-500',
        priority: 'normal',
        completed: false,
    },
    {
        id: 4,
        title: 'Meditate 10 mins daily',
        description: '-',
        list: 'Personal Goals',
        listColor: 'bg-violet-500',
        priority: 'normal',
        completed: true,
    },
]

const hasActiveFilters = computed(
    () => search.value !== '' || listFilter.value !== 'all' || priorityFilter.value !== 'all',
)

function clearFilters() {
    search.value = ''
    listFilter.value = 'all'
    priorityFilter.value = 'all'
}

function priorityClasses(priority: Task['priority']) {
    switch (priority) {
        case 'high':
            return 'bg-red-500 text-white'
        case 'low':
            return 'bg-muted text-muted-foreground'
        default:
            return 'bg-foreground text-background'
    }
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
                    View and manage all your tasks ({{ totalTasks }} total)
                </p>
            </div>
            <Button>
                <Plus class="mr-2 h-4 w-4" />
                Add Task
            </Button>
        </div>

        <!-- Filters card -->
        <div class="rounded-xl border bg-card p-6">
            <div class="mb-4 flex items-center justify-between">
                <h2 class="font-medium">
                    Filters
                </h2>
                <button v-if="hasActiveFilters" type="button"
                    class="flex items-center gap-1 text-sm text-muted-foreground hover:text-foreground"
                    @click="clearFilters">
                    <X class="h-3.5 w-3.5" />
                    Clear Filters
                </button>
            </div>

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                <div class="space-y-1.5">
                    <label class="text-sm text-muted-foreground">Search</label>
                    <div class="relative">
                        <Search
                            class="pointer-events-none absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-muted-foreground" />
                        <Input v-model="search" placeholder="Search tasks..." class="pl-9" />
                    </div>
                </div>

                <div class="space-y-1.5">
                    <label class="text-sm text-muted-foreground">List</label>
                    <Select v-model="listFilter">
                        <SelectTrigger>
                            <SelectValue placeholder="All Lists" />
                        </SelectTrigger>
                        <SelectContent>
                            <SelectItem value="all">
                                All Lists
                            </SelectItem>
                            <SelectItem value="shopping-list">
                                Shopping List
                            </SelectItem>
                            <SelectItem value="personal-goals">
                                Personal Goals
                            </SelectItem>
                        </SelectContent>
                    </Select>
                </div>

                <div class="space-y-1.5">
                    <label class="text-sm text-muted-foreground">Priority</label>
                    <Select v-model="priorityFilter">
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
                <h2 class="font-medium">
                    Tasks ({{ tasks.length }} of {{ totalTasks }})
                </h2>
            </div>

            <Table>
                <TableHeader>
                    <TableRow>
                        <TableHead>Title</TableHead>
                        <TableHead>Description</TableHead>
                        <TableHead>List</TableHead>
                        <TableHead>Priority</TableHead>
                        <TableHead class="text-right">
                            Actions
                        </TableHead>
                    </TableRow>
                </TableHeader>
                <TableBody>
                    <TableRow v-for="task in tasks" :key="task.id">
                        <!-- Title with status circle/check -->
                        <TableCell>
                            <div class="flex items-center gap-3">
                                <button type="button"
                                    class="flex h-5 w-5 shrink-0 items-center justify-center rounded-full border"
                                    :class="task.completed
                                        ? 'border-emerald-500 bg-emerald-500/10 text-emerald-500'
                                        : 'border-muted-foreground/40'">
                                    <svg v-if="task.completed" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="3" class="h-3 w-3">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                    </svg>
                                </button>
                                <span :class="task.completed ? 'text-muted-foreground line-through' : 'font-medium'">
                                    {{ task.title }}
                                </span>
                            </div>
                        </TableCell>

                        <!-- Description -->
                        <TableCell class="text-muted-foreground">
                            {{ task.description }}
                        </TableCell>

                        <!-- List with colored dot -->
                        <TableCell>
                            <div class="flex items-center gap-2">
                                <span class="h-2 w-2 rounded-full" :class="task.listColor" />
                                <span>{{ task.list }}</span>
                            </div>
                        </TableCell>

                        <!-- Priority badge -->
                        <TableCell>
                            <span class="inline-flex items-center rounded-md px-2 py-0.5 text-xs font-medium capitalize"
                                :class="priorityClasses(task.priority)">
                                {{ task.priority }}
                            </span>
                        </TableCell>

                        <!-- Actions -->
                        <TableCell class="text-right">
                            <div class="flex items-center justify-end gap-3">
                                <button type="button" class="text-muted-foreground hover:text-foreground">
                                    <Pencil class="h-4 w-4" />
                                </button>
                                <button type="button" class="text-muted-foreground hover:text-destructive">
                                    <Trash2 class="h-4 w-4" />
                                </button>
                            </div>
                        </TableCell>
                    </TableRow>
                </TableBody>
            </Table>
        </div>
    </div>
</template>