import { PlaceholderPattern } from '@/components/ui/placeholder-pattern';
import AppLayout from '@/layouts/app-layout';
import { Task, type BreadcrumbItem } from '@/types';
import { Head, Link } from '@inertiajs/react';
import {
    Table,
    TableBody,
    TableCaption,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
  } from "@/components/ui/table"

  import { BadgeCheck, BadgeX } from "lucide-react";


const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Tasks',
        href: '/tasks',
    },
];

export default function TasksIndex({tasks}: {tasks: Task[]}) {
    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Tasks" />
            <div className="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
                <div className='flex justify-end'>
                    <Link href='/tasks/create' className='text-green-500 hover:text-green-600'>Create Task</Link>
                </div>
                <div className="border-sidebar-border/70 dark:border-sidebar-border relative min-h-[100vh] flex-1 overflow-hidden rounded-xl border md:min-h-min">
                <Table>
                    <TableCaption>A list of your recent tasks.</TableCaption>
                    <TableHeader>
                        <TableRow>
                        <TableHead className="w-[100px]">ID</TableHead>
                        <TableHead>Title</TableHead>
                        <TableHead>Completed</TableHead>
                        <TableHead className="text-right">Action</TableHead>
                        </TableRow>
                    </TableHeader>
                    <TableBody>
                        {tasks.map((task: Task) => (
                             <TableRow key={task.id}>
                             <TableCell className="font-medium">{task.id}</TableCell>
                             <TableCell>{task.title}</TableCell>
                             <TableCell>{task.completed ? <BadgeCheck className="text-green-500" /> : <BadgeX className="text-red-500" />}</TableCell>
                             <TableCell className="text-right">
                                <Link href={`/tasks/${task.id}/edit`} className="text-blue-500 hover:text-blue-600">Edit</Link>
                             </TableCell>
                             </TableRow>
                        ))}
                    </TableBody>
                    </Table>
                </div>
            </div>
        </AppLayout>
    );
}
