<script setup lang="ts">
import { Plus, ExternalLink, Pencil, Trash2 } from '@lucide/vue'
import { Button } from '@/components/ui/button'

interface TaskList {
    id: number
    name: string
    color: string
    taskCount: number
}

const lists: TaskList[] = [
    { id: 1, name: 'Personal Goals', color: 'bg-violet-500', taskCount: 3 },
    { id: 2, name: 'Work Projects', color: 'bg-blue-500', taskCount: 4 },
    { id: 3, name: 'Shopping List', color: 'bg-emerald-500', taskCount: 4 },
    { id: 4, name: 'Fitness Tracker', color: 'bg-amber-500', taskCount: 3 },
    { id: 5, name: 'Travel Plans', color: 'bg-pink-500', taskCount: 3 },
    { id: 6, name: 'Book Reading List', color: 'bg-indigo-500', taskCount: 2 },
    { id: 7, name: 'Home Improvements', color: 'bg-teal-500', taskCount: 2 },
    { id: 8, name: 'Learning Roadmap', color: 'bg-orange-500', taskCount: 2 },
    { id: 9, name: 'Gift Ideas', color: 'bg-purple-500', taskCount: 2 },
    { id: 10, name: 'Weekend Chores', color: 'bg-cyan-500', taskCount: 3 },
]
</script>

<template>
    <div class="p-6 space-y-6">
        <!-- Page header -->
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-semibold tracking-tight">
                    Lists
                </h1>
                <p class="text-sm text-muted-foreground">
                    Manage your task lists
                </p>
            </div>
            <Button>
                <Plus class="mr-2 h-4 w-4" />
                Create List
            </Button>
        </div>

        <!-- Lists grid -->
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
            <div v-for="list in lists" :key="list.id" class="rounded-xl border bg-card p-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <span class="h-2.5 w-2.5 shrink-0 rounded-full" :class="list.color" />
                        <h3 class="font-medium">
                            {{ list.name }}
                        </h3>
                    </div>
                    <span class="text-sm text-muted-foreground">{{ list.taskCount }}</span>
                </div>

                <p class="mt-2 text-sm text-muted-foreground">
                    {{ list.taskCount }} tasks
                </p>

                <div class="mt-4 flex items-center gap-2">
                    <button type="button"
                        class="flex flex-1 items-center justify-center gap-1.5 rounded-md border px-3 py-1.5 text-sm hover:bg-accent">
                        <ExternalLink class="h-3.5 w-3.5" />
                        View
                    </button>
                    <button type="button"
                        class="flex h-8 w-8 items-center justify-center rounded-md border hover:bg-accent">
                        <Pencil class="h-3.5 w-3.5" />
                    </button>
                    <button type="button"
                        class="flex h-8 w-8 items-center justify-center rounded-md bg-red-500 text-white hover:bg-red-600">
                        <Trash2 class="h-3.5 w-3.5" />
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>